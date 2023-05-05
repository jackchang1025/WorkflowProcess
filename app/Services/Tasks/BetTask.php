<?php

namespace App\Services\Tasks;

use App\Models\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use ProcessMaker\Nayra\Bpmn\ActivityTrait;
use ProcessMaker\Nayra\Bpmn\Models\ServiceTask;
use ProcessMaker\Nayra\Contracts\Bpmn\ActivityInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\TokenInterface;

class BetTask extends ServiceTask
{
    use ActivityTrait;

    const TAG_NAME = 'betTask';

    /**
     * 返回一个数组，该数组定义了 BPMN 元素的自定义事件类。
     * @return array
     */
    protected function getBpmnEventClasses(): array
    {
        return [
//            ServiceTaskInterface::EVENT_SERVICE_TASK_ACTIVATED => ServiceTaskActivatedEvent::class,
        ];
    }


    /**
     * 执行服务任务。首先尝试执行服务任务实现（通过 executeService() 方法），如果执行成功，调用 complete() 方法完成任务；否则，将令牌设置为失败状态
     * @param TokenInterface $token
     * @return GetLotteryDataTask|$this
     * @throws \Throwable
     */
    public function run(TokenInterface $token): GetLotteryDataTask|static
    {
        Log::channel()->info('betTask run');

        if ($this->executeService($token)) {

            $this->complete($token);

        } else {
            // 如果请求失败，将令牌设置为失败状态
            $token->setStatus(ActivityInterface::TOKEN_STATE_FAILING);
        }
        return $this;
    }

    /**
     * 服务任务执行器，用于执行服务任务的实现。这里的实现仅用于测试目的。这个方法尝试调用服务任务的实现，如果调用成功返回 true，否则返回 false。
     * @param TokenInterface $token
     * @return bool
     * @throws \Throwable
     */
    private function executeService(TokenInterface $token): bool
    {
        /**
         * @var Request $request
         */
        $request = $token->getInstance()->getDataStore()->getData('request');

        $lotteryManage = $request->lotteryManage();

        $lotteryCurrentInfo = $lotteryManage->lotteryCurrentInfo();

        throw_if(empty($currentIssue = $lotteryCurrentInfo['issue']), new Exception('获取当前期号失败'));

        //开始投注 金额单位分
        $lotteryManage->lotteryBet($currentIssue, $request->current_bet_code_rule, $request->current_bet_amount_rule * 100);

        //投注总次数
        $request->bet_count_rules++;

        //投注规则
        $request->bet_code_rules .= $request->current_bet_code_rule;

        //投注金额规则
        $request->bet_amount_rules .= ',' . $request->current_bet_amount_rule;

        //减去总金额
        $request->bet_total_amount_rules -= $request->current_bet_amount_rule;

        //获取玩法规则
        $odds = $request->requestLotteryOption()->where('value', $request->current_bet_code_rule)->value('odds');

        //生成投注单投注日志
        $requestLog = $request->requestLog()->create([
            'issue'            => $currentIssue,
            'bet_code'         => $request->current_bet_code_rule,
            'bet_amount'       => $request->current_bet_amount_rule,
            'bet_total_amount' => $request->bet_total_amount_rules,
            'bet_code_odds'    => $odds,
        ]);

        Log::info('生成投注单投注日志', ['betOrderLogBettingLog' => $requestLog]);

        return true;
    }
}
