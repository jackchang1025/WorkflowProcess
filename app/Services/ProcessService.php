<?php

namespace App\Services;

use App\Events\ProcessInstanceCompletedEvent;
use App\Models\Request;
use App\Services\Engine\BpmnEngine;
use App\Services\Engine\EventEngine;
use App\Services\Engine\RepositoryEngine;
use Illuminate\Support\Facades\Log;
use ProcessMaker\Nayra\Bpmn\Models\Process;
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

        // 替换 BPMN 文档中的元素
//        $this->replaceBpmElement();

        // 从 BPMN 文档中获取流程定义
        /**
         * @var Process $process
         */
        $process = $this->bpmnDocument->getProcess('Process_1');

        $dataStore = $this->repositoryEngine->createDataStore()
            ->putData('request_id', $request->id)
            ->putData('lotteryManage',$request->lotteryManage());

        $executionInstanceInterface = $process->call($dataStore);


        $process->getDispatcher()->listen('ServiceTaskActivated', function (string $event, $payload) {

            event(new \App\Events\ServiceTaskActivatedEvent($payload[0], $payload[1]));

            Log::info("{$event} ===> " . $payload[1]->getProperty('id') ?? "");
        });


        //ProcessInstanceCompleted 工作流完成事件
        //GatewayActivated 网关事件
        //ConditionedTransition 条件转换事件
        //ServiceTaskActivated ServiceTask事件

        $this->bpmnEngine->runToNextState();

        Log::info("end");

        event(new ProcessInstanceCompletedEvent($request->id));

        return $this->bpmnEngine;
    }

}
