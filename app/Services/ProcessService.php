<?php

namespace App\Services;

use App\Events\ProcessInstanceCompletedEvent;
use App\Models\Request;
use App\Services\Engine\BpmnEngine;
use App\Services\Engine\EventEngine;
use App\Services\Engine\RepositoryEngine;
use App\Services\Events\EndEventService;
use App\Services\Events\StartEventService;
use App\Services\Tasks\BetTask;
use App\Services\Tasks\CreateBetAmountTask;
use App\Services\Tasks\CreateBetCodeTask;
use App\Services\Tasks\FormActivityTask;
use App\Services\Tasks\GetLotteryDataTask;
use Illuminate\Support\Facades\Log;
use ProcessMaker\Nayra\Bpmn\Models\Process;
use ProcessMaker\Nayra\Contracts\Bpmn\ActivityInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\EndEventInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\EventDefinitionInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\EventInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\FlowNodeInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\LoopCharacteristicsInterface;
use ProcessMaker\Nayra\Storage\BpmnDocument;

class ProcessService
{
    const NAMESPACE = 'http://www.omg.org/spec/BPMN/20100524/MODEL';

    protected array $tasks = [
        [
            'namespace' => self::NAMESPACE,
            'tagName'   => GetLotteryDataTask::TAG_NAME,
            'mapping'   => [
                GetLotteryDataTask::class,
                [
                    FlowNodeInterface::BPMN_PROPERTY_INCOMING             => ['n', [BpmnDocument::BPMN_MODEL, FlowNodeInterface::BPMN_PROPERTY_INCOMING]],
                    FlowNodeInterface::BPMN_PROPERTY_OUTGOING             => ['n', [BpmnDocument::BPMN_MODEL, FlowNodeInterface::BPMN_PROPERTY_OUTGOING]],
                    ActivityInterface::BPMN_PROPERTY_LOOP_CHARACTERISTICS => ['1', LoopCharacteristicsInterface::class],
                    ActivityInterface::BPMN_PROPERTY_IO_SPECIFICATION     => ['1', [BpmnDocument::BPMN_MODEL, ActivityInterface::BPMN_PROPERTY_IO_SPECIFICATION]],
                ],
            ]
        ],
        [
            'namespace' => self::NAMESPACE,
            'tagName'   => CreateBetAmountTask::TAG_NAME,
            'mapping'   => [
                CreateBetAmountTask::class,
                [
                    FlowNodeInterface::BPMN_PROPERTY_INCOMING             => ['n', [BpmnDocument::BPMN_MODEL, FlowNodeInterface::BPMN_PROPERTY_INCOMING]],
                    FlowNodeInterface::BPMN_PROPERTY_OUTGOING             => ['n', [BpmnDocument::BPMN_MODEL, FlowNodeInterface::BPMN_PROPERTY_OUTGOING]],
                    ActivityInterface::BPMN_PROPERTY_LOOP_CHARACTERISTICS => ['1', LoopCharacteristicsInterface::class],
                    ActivityInterface::BPMN_PROPERTY_IO_SPECIFICATION     => ['1', [BpmnDocument::BPMN_MODEL, ActivityInterface::BPMN_PROPERTY_IO_SPECIFICATION]],
                ],
            ]
        ],
        [
            'namespace' => self::NAMESPACE,
            'tagName'   => CreateBetCodeTask::TAG_NAME,
            'mapping'   => [
                CreateBetCodeTask::class,
                [
                    FlowNodeInterface::BPMN_PROPERTY_INCOMING             => ['n', [BpmnDocument::BPMN_MODEL, FlowNodeInterface::BPMN_PROPERTY_INCOMING]],
                    FlowNodeInterface::BPMN_PROPERTY_OUTGOING             => ['n', [BpmnDocument::BPMN_MODEL, FlowNodeInterface::BPMN_PROPERTY_OUTGOING]],
                    ActivityInterface::BPMN_PROPERTY_LOOP_CHARACTERISTICS => ['1', LoopCharacteristicsInterface::class],
                    ActivityInterface::BPMN_PROPERTY_IO_SPECIFICATION     => ['1', [BpmnDocument::BPMN_MODEL, ActivityInterface::BPMN_PROPERTY_IO_SPECIFICATION]],
                ],
            ]
        ],
        [
            'namespace' => self::NAMESPACE,
            'tagName'   => BetTask::TAG_NAME,
            'mapping'   => [
                BetTask::class,
                [
                    FlowNodeInterface::BPMN_PROPERTY_INCOMING             => ['n', [BpmnDocument::BPMN_MODEL, FlowNodeInterface::BPMN_PROPERTY_INCOMING]],
                    FlowNodeInterface::BPMN_PROPERTY_OUTGOING             => ['n', [BpmnDocument::BPMN_MODEL, FlowNodeInterface::BPMN_PROPERTY_OUTGOING]],
                    ActivityInterface::BPMN_PROPERTY_LOOP_CHARACTERISTICS => ['1', LoopCharacteristicsInterface::class],
                    ActivityInterface::BPMN_PROPERTY_IO_SPECIFICATION     => ['1', [BpmnDocument::BPMN_MODEL, ActivityInterface::BPMN_PROPERTY_IO_SPECIFICATION]],
                ],
            ]
        ],
        [
            'namespace' => self::NAMESPACE,
            'tagName'   => FormActivityTask::TAG_NAME,
            'mapping'   => [
                FormActivityTask::class,
                [
                    FlowNodeInterface::BPMN_PROPERTY_INCOMING             => ['n', [BpmnDocument::BPMN_MODEL, FlowNodeInterface::BPMN_PROPERTY_INCOMING]],
                    FlowNodeInterface::BPMN_PROPERTY_OUTGOING             => ['n', [BpmnDocument::BPMN_MODEL, FlowNodeInterface::BPMN_PROPERTY_OUTGOING]],
                    ActivityInterface::BPMN_PROPERTY_LOOP_CHARACTERISTICS => ['1', LoopCharacteristicsInterface::class],
                    ActivityInterface::BPMN_PROPERTY_IO_SPECIFICATION     => ['1', [BpmnDocument::BPMN_MODEL, ActivityInterface::BPMN_PROPERTY_IO_SPECIFICATION]],
                ],
            ]
        ],
        [
            'namespace' => self::NAMESPACE,
            'tagName'   => EndEventService::TAG_NAME,
            'mapping'   => [
                EndEventService::class,
                [
                    FlowNodeInterface::BPMN_PROPERTY_INCOMING          => ['n', [BpmnDocument::BPMN_MODEL, FlowNodeInterface::BPMN_PROPERTY_INCOMING]],
                    FlowNodeInterface::BPMN_PROPERTY_OUTGOING          => ['n', [BpmnDocument::BPMN_MODEL, FlowNodeInterface::BPMN_PROPERTY_OUTGOING]],
                    EndEventInterface::BPMN_PROPERTY_EVENT_DEFINITIONS => ['n', EventDefinitionInterface::class],
                ],
            ]
        ],
        [
            'namespace' => self::NAMESPACE,
            'tagName'   => StartEventService::TAG_NAME,
            'mapping'   => [
                StartEventService::class,
                [
                    FlowNodeInterface::BPMN_PROPERTY_INCOMING       => ['n', [BpmnDocument::BPMN_MODEL, FlowNodeInterface::BPMN_PROPERTY_INCOMING]],
                    FlowNodeInterface::BPMN_PROPERTY_OUTGOING       => ['n', [BpmnDocument::BPMN_MODEL, FlowNodeInterface::BPMN_PROPERTY_OUTGOING]],
                    EventInterface::BPMN_PROPERTY_EVENT_DEFINITIONS => ['n', EventDefinitionInterface::class],
                ],
            ]
        ],
    ];

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

        // 注册自定义活动处理器
        $this->registerBpmnElementMappings();

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
        $this->replaceBpmElement();

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

    public function registerBpmnElementMappings(): void
    {
        foreach ($this->tasks as $mapping) {
            $this->bpmnDocument->setBpmnElementMapping($mapping['namespace'], $mapping['tagName'], $mapping['mapping']);
        }
    }

    public function replaceBpmElement(): void
    {
        // 获取BPMN XML中所有的serviceTask元素
        $serviceTasks = $this->bpmnDocument->getElementsByTagName('serviceTask');

        // 创建一个数组来存储所有的serviceTask元素
        $serviceTasksArray = [];
        foreach ($serviceTasks as $serviceTask) {
            $serviceTasksArray[] = $serviceTask;
        }

        // 遍历并处理每个serviceTask元素
        foreach ($serviceTasksArray as $serviceTask) {
            // 获取serviceTask元素的name属性的值
            $name = $serviceTask->getAttribute('name');
            // 获取serviceTask元素的 namespaceURI 属性的值
            $namespaceURI = $serviceTask->namespaceURI;

            // 创建一个新的DOM元素，使用name属性的值作为标签名
            $newElement = $this->bpmnDocument->createElementNS($namespaceURI, $name);

            // 为新元素设置name,namespaceURI 属性
            $newElement->setAttribute('name', $name);

            // 将serviceTask元素的所有属性复制到新元素
            foreach ($serviceTask->attributes as $attribute) {
                $newElement->setAttribute($attribute->name, $attribute->value);
            }

            // 将serviceTask元素的所有子元素移动到新元素
            while ($serviceTask->firstChild) {
                $newElement->appendChild($serviceTask->firstChild);
            }

            // 使用新元素替换原始的serviceTask元素
            $serviceTask->parentNode->replaceChild($newElement, $serviceTask);
        }
    }

}
