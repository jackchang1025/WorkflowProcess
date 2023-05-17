<?php

namespace App\Services;

use App\Events\ProcessInstanceCompletedEvent;
use App\Events\ScriptTaskActivatedEvent;
use App\Events\ServiceTaskActivatedEvent;
use App\Models\Request;
use App\Services\Engine\BpmnEngine;
use App\Services\Engine\EventEngine;
use App\Services\Engine\RepositoryEngine;
use ProcessMaker\Nayra\Bpmn\Models\DataStore;
use ProcessMaker\Nayra\Bpmn\Models\Process;
use ProcessMaker\Nayra\Contracts\Bpmn\DataStoreInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\ScriptTaskInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\ServiceTaskInterface;
use ProcessMaker\Nayra\Storage\BpmnDocument;

class ProcessService
{
    const NAMESPACE = 'http://www.omg.org/spec/BPMN/20100524/MODEL';

    protected BpmnEngine $bpmnEngine;

    public function __construct(
        protected RepositoryEngine $repositoryEngine,
        protected EventEngine      $eventEngine,
        protected BpmnDocument     $bpmnDocument,
    )
    {
        $this->bpmnEngine = new BpmnEngine($this->repositoryEngine, $this->eventEngine);
        $this->bpmnDocument->setEngine($this->bpmnEngine);
        $this->bpmnDocument->setFactory($this->repositoryEngine);
    }

    /**
     * @param Request $request
     * @return BpmnEngine
     */
    public function handle(Request $request): BpmnEngine
    {
        $this->loadBpmnDocument($request->bpmn_xml);
        $process = $this->getProcessFromDocument('Process_1');
        $dataStore = $this->createDataStore($request);
        $process->call($dataStore);
        $this->defineEventListeners($process);
        $this->bpmnEngine->runToNextState();
        event(new ProcessInstanceCompletedEvent($request->id));
        return $this->bpmnEngine;
    }

    /**
     * @param string $bpmnXml
     * @return void
     */
    protected function loadBpmnDocument(string $bpmnXml): void
    {
        $this->bpmnDocument->loadXML($bpmnXml);
    }

    /**
     * @param string $processId
     * @return Process
     */
    protected function getProcessFromDocument(string $processId): Process
    {
        return $this->bpmnDocument->getProcess($processId);
    }

    /**
     * @param Request $request
     * @return DataStore|DataStoreInterface
     */
    protected function createDataStore(Request $request): DataStore|DataStoreInterface
    {
        return $this->repositoryEngine->createDataStore()
            ->putData('request_id', $request->id)
            ->putData('lotteryManage', $request->lotteryManage());
    }

    /**
     * @param Process $process
     * @return void
     */
    protected function defineEventListeners(Process $process): void
    {
        $process->getDispatcher()->listen(ServiceTaskInterface::EVENT_SERVICE_TASK_ACTIVATED, function (string $event, $payload) {
            event(new ServiceTaskActivatedEvent($payload[0], $payload[1]));
        });

        $process->getDispatcher()->listen(ScriptTaskInterface::EVENT_SCRIPT_TASK_ACTIVATED, function (string $event, $payload) {
            event(new ScriptTaskActivatedEvent($payload[0], $payload[1]));
        });
    }
}
