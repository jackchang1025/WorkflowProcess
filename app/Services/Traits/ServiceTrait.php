<?php

namespace App\Services\Traits;

use App\Models\Request;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use ProcessMaker\Nayra\Contracts\Bpmn\TokenInterface;

trait ServiceTrait
{
    /**
     * @param TokenInterface $token
     * @param $implementation
     * @return bool
     * @throws Exception
     */
    protected function executeService(TokenInterface $token, $implementation): bool
    {
        $callable = is_string($implementation) && strpos($implementation, '@') ? explode('@', $implementation) : $implementation;

        // 获取 Laravel 容器中的实例
        if (is_string($callable) && class_exists($callable)) {
            $callable = app($callable);
        }

        // 如果实例存在 __invoke() 方法，则调用它并传递 $token
        if (is_object($callable) && method_exists($callable, '__invoke')) {
            $callable($token);
        } else {
            call_user_func($callable, $token);
        }

        return true;
    }

    /**
     * @param int $requestId
     * @return Model|array|Collection|Request|null
     * @throws \Throwable
     */
    public function getRequest(int $requestId): Model|array|Collection|Request|null
    {
        $request = Request::find($requestId);

        throw_if(!$request, new \Exception('请求不存在'));

        throw_if($request->status == Request::STATUS_STOP, new \Exception('请求已取消'));

        return $request;
    }
}
