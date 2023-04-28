<?php

namespace App\Services\Events;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use ProcessMaker\Nayra\Bpmn\StartEventTrait;
use ProcessMaker\Nayra\Contracts\Bpmn\MessageListenerInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\StartEventInterface;
use ProcessMaker\Nayra\Contracts\Engine\ExecutionInstanceInterface;


class StartEventService implements StartEventInterface, MessageListenerInterface
{
    use StartEventTrait;

    const TAG_NAME = 'startEvent';

    public function start(ExecutionInstanceInterface $instance): StartEventService|static
    {
        Log::channel()->info('StartEventService start');

        $this->triggerPlace[0]->addNewToken($instance);

        $attributes = $instance->getOwnerDocument();

        $dataStore = $instance->getDataStore();


        $tempModel = new class([], 'temporary_table') extends Model {
            protected $fillable = ['lottery_id', 'lottery_option','base_bet_amount','total_bet_amount'];

            // 如果需要其他方法或属性，可以在这里添加
        };



        //开奖规则
        $tempModel->lottery_rule = '';

        //开奖次数规则
        $tempModel->lottery_conut_rule = 0;

        //总金额规则
        $tempModel->total_amount_rule = 1000;

        //基础金额规则
        $tempModel->base_amount_rule = 20;

        //投注金额规则
        $tempModel->bet_amount_rule = 0;

        //投注码规则
        $tempModel->bet_code_rule = 0;

        //投注总总码规则
        $tempModel->bet_tatal_code_rule = '';

        //投注次数规则
        $tempModel->bet_lottery_rule = 0;

        //输赢规则
        $tempModel->win_lose_rule = '';

        $dataStore->putData('model', $tempModel);

        return $this;
    }


    protected function getBpmnEventClasses()
    {
        return [];
    }
}
