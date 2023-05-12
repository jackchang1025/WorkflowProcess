<?php

namespace App\Services;

use App\Events\ProcessInstanceCompletedEvent;
use App\Events\ScriptTaskActivatedEvent;
use App\Events\ServiceTaskActivatedEvent;
use App\Models\Request;
use App\Services\Engine\BpmnEngine;
use App\Services\Engine\EventEngine;
use App\Services\Engine\RepositoryEngine;
use ProcessMaker\Nayra\Bpmn\Models\Process;
use ProcessMaker\Nayra\Contracts\Bpmn\ScriptTaskInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\ServiceTaskInterface;
use ProcessMaker\Nayra\Storage\BpmnDocument;

class ProcessService
{
    const NAMESPACE = 'http://www.omg.org/spec/BPMN/20100524/MODEL';

    protected readonly BpmnEngine $bpmnEngine;

    /**
     * @param RepositoryEngine $repositoryEngine
     * @param EventEngine $eventEngine
     * @param BpmnDocument $bpmnDocument
     */
    public function __construct(
        protected readonly RepositoryEngine $repositoryEngine,
        protected readonly EventEngine      $eventEngine,
        protected readonly BpmnDocument     $bpmnDocument,
    )
    {
        // 实例化引擎
        $this->bpmnEngine = new BpmnEngine($this->repositoryEngine, $this->eventEngine);

        $this->bpmnDocument->setEngine($this->bpmnEngine);
        $this->bpmnDocument->setFactory($this->repositoryEngine);

    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function handle(Request $request): mixed
    {
        // 加载 BPMN 文档
        $this->bpmnDocument->loadXML($request->bpmn_xml);

        /**
         * 从 BPMN 文档中获取流程定义
         * @var Process $process
         */
        $process = $this->bpmnDocument->getProcess('Process_1');

        $dataStore = $this->repositoryEngine->createDataStore()
            ->putData('request_id', $request->id)
            ->putData('lotteryManage', $request->lotteryManage());

        $process->call($dataStore);

        //定义ServiceTaskActivated事件监听
        $process->getDispatcher()->listen(ServiceTaskInterface::EVENT_SERVICE_TASK_ACTIVATED, function (string $event, $payload) {

            event(new ServiceTaskActivatedEvent($payload[0], $payload[1]));

        });

        //定义ScriptTaskActivated事件监听
        $process->getDispatcher()->listen(ScriptTaskInterface::EVENT_SCRIPT_TASK_ACTIVATED, function (string $event, $payload) {

            event(new ScriptTaskActivatedEvent($payload[0], $payload[1]));

        });

        //ProcessInstanceCompleted 工作流完成事件
        //GatewayActivated 网关事件
        //ConditionedTransition 条件转换事件
        //ServiceTaskActivated ServiceTask事件

        //运行到下一个状态
        $this->bpmnEngine->runToNextState();

        //工作流完成事件
        event(new ProcessInstanceCompletedEvent($request->id));

        return $this->bpmnEngine;
    }

}
