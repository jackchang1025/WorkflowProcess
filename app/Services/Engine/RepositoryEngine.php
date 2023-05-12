<?php

namespace App\Services\Engine;


use App\Services\Events\EndEventService;
use App\Services\Events\StartEventService;
use App\Services\Expressions\FormalExpression;
use App\Services\Models\CallActivity;
use App\Services\Tasks\ScriptTask;
use App\Services\Tasks\ServiceTask;
use Exception;
use ProcessMaker\Nayra\Contracts\RepositoryInterface;
use ProcessMaker\Nayra\RepositoryTrait;
use ReflectionClass;

/**
 * Repository
 *
 * @package ProcessMaker\Test\Models
 */
class RepositoryEngine implements RepositoryInterface
{
    //实现了 RepositoryInterface 接口中核心方法
    use RepositoryTrait {create as parentCreate;}

    /**
     * 创建一个 FormalExpression 类的实例。FormalExpression 是一个用于表示 BPMN 表达式的类，通常用于条件、脚本等地方
     *
     * @return \ProcessMaker\Nayra\Contracts\Bpmn\FormalExpressionInterface
     */
    public function createFormalExpression()
    {
        return new FormalExpression();
    }

    /**
     * 创建一个 CallActivity 类的实例。CallActivity 是一个 BPMN 构造，表示在一个流程中调用另一个流程
     *
     * @return \ProcessMaker\Nayra\Contracts\Bpmn\CallActivityInterface
     */
    public function createCallActivity()
    {
        return new CallActivity();
    }

    /**
     * 这个方法创建一个 ExecutionInstanceRepository 类的实例。ExecutionInstanceRepository 是一个用于管理和存储流程执行实例的仓库类
     *
     * @return ExecutionInstanceRepository
     */
    public function createExecutionInstanceRepository()
    {
        return new ExecutionInstanceRepository();
    }

    /**
     * 获取一个 TokenRepositoryEngine 类的实例。如果实例尚未创建，则创建一个新的实例并将其分配给 $this->tokenRepo 属性。TokenRepositoryEngine 是一个用于管理和存储令牌的仓库类。令牌是 BPMN 引擎中用于表示流程实例中的活动状态的实体
     * @return TokenRepositoryEngine|\ProcessMaker\Nayra\Contracts\Repositories\TokenRepositoryInterface|null
     */
    public function getTokenRepository()
    {
        if ($this->tokenRepo === null) {
            $this->tokenRepo = new TokenRepositoryEngine();
        }
        return $this->tokenRepo;

    }

    /**
     * @param $interfaceName
     * @param ...$constructorArguments
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws Exception
     */
    public function create($interfaceName, ...$constructorArguments): mixed
    {
        $reflector = new ReflectionClass($interfaceName);
        $namespace = $reflector->getNamespaceName();

        // 检查命名空间是否以 "App" 开头
        if (str_starts_with($namespace, 'App')) {
            return app()->make($interfaceName, $constructorArguments);
        }

        return $this->parentCreate($interfaceName, ...$constructorArguments);
    }

    /**
     * Create instance of ServiceTask.
     *
     * @return \ProcessMaker\Nayra\Contracts\Bpmn\ServiceTaskInterface
     */
    public function createServiceTask()
    {
        return new ServiceTask();
    }

    /**
     * Create instance of StartEvent.
     *
     * @return \ProcessMaker\Nayra\Contracts\Bpmn\StartEventInterface
     */
    public function createStartEvent()
    {
        return new StartEventService();
    }

    /**
     * Create instance of EndEvent.
     *
     * @return \ProcessMaker\Nayra\Contracts\Bpmn\EndEventInterface
     */
    public function createEndEvent()
    {
        return new EndEventService();
    }

    /**
     * Create instance of ScriptTask.
     *
     * @return \ProcessMaker\Nayra\Contracts\Bpmn\ScriptTaskInterface
     */
    public function createScriptTask()
    {
        return new ScriptTask();
    }
}
