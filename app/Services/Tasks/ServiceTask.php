<?php

namespace App\Services\Tasks;


use App\Services\Traits\ServiceTrait;
use ProcessMaker\Nayra\Bpmn\Models\ServiceTask as BaseServiceTask;
use ProcessMaker\Nayra\Contracts\Bpmn\ActivityInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\TokenInterface;

class ServiceTask extends BaseServiceTask
{
    use ServiceTrait;

    /**
     * @param TokenInterface $token
     * @return $this|ServiceTask
     * @throws \Exception
     */
    public function run(TokenInterface $token): ServiceTask|static
    {
        //if the script runs correctly complete te activity, otherwise set the token to failed state
        if ($this->executeService($token, $this->getImplementation())) {
            $this->complete($token);
        } else {
            $token->setStatus(ActivityInterface::TOKEN_STATE_FAILING);
        }

        return $this;
    }
}
