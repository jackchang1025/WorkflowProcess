<?php

namespace App\Services\Tasks;

use App\Models\Request;
use Illuminate\Support\Facades\Log;
use ProcessMaker\Nayra\Bpmn\Models\ScriptTask as BaseScriptTask;
use ProcessMaker\Nayra\Contracts\Bpmn\ActivityInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\MultiInstanceLoopCharacteristicsInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\TokenInterface;

class ScriptTask extends BaseScriptTask
{

    /**
     * Runs the ScriptTask
     * @param TokenInterface $token
     */
    public function runScript(TokenInterface $token)
    {
        //if the script runs correctly complete te activity, otherwise set the token to failed state
        if ($this->executeScript($token, $this->getScript())) {
            $this->complete($token);
        } else {
            $token->setStatus(ActivityInterface::TOKEN_STATE_FAILING);
        }
    }

    /**
     * @param TokenInterface $token
     * @param $script
     * @return bool
     */
    public function executeScript(TokenInterface $token, $script): bool
    {
        $result = true;
        try {
            $element = $token->getOwnerElement();
            $loop    = $element->getLoopCharacteristics();
            $isMulti = $loop instanceof MultiInstanceLoopCharacteristicsInterface && $loop->isExecutable();
            if ($isMulti) {
                $data = $token->getProperty('data', []);
            } else {
                $data = $token->getInstance()->getDataStore()->getData();
            }

            $request = Request::findOrStatusFail($data['request_id']);

            $newData = eval($script);

            Log::channel('ondemand')->debug('ScriptTask 任务执行', ['script' => $script, 'newData' => $newData]);

            if (gettype($newData) === 'array') {
                $data = array_merge($data, $newData);
                if ($isMulti) {
                    $token->setProperty('data', $data);
                } else {
                    $token->getInstance()->getDataStore()->setData($data);
                }
            }
        } catch (\Exception|\Throwable $e) {

            Log::channel('ondemand')->error($e->getMessage(),['script' => $script, 'App\Models\Request' => !empty($request) ? $request->toArray() : null]);
            $result = false;
        }

        return $result;
    }
}
