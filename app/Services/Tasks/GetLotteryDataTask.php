<?php

namespace App\Services\Tasks;

use App\Models\Lottery;
use App\Models\LotteryOption;
use App\Models\Request;
use App\Models\RequestLog;
use App\Services\Events\ServiceTaskActivatedEvent;
use App\Services\Lottery\LotteryOptionService;
use Illuminate\Support\Facades\Log;
use ProcessMaker\Nayra\Bpmn\ActivityTrait;
use ProcessMaker\Nayra\Bpmn\Models\ServiceTask;
use ProcessMaker\Nayra\Contracts\Bpmn\ActivityInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\ServiceTaskInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\TokenInterface;

class GetLotteryDataTask extends ServiceTask
{
    use ActivityTrait;

    protected LotteryOptionService $lotteryOptionService;

    const TAG_NAME = 'getLotteryDataTask';

    public function __construct(...$args)
    {
        parent::__construct($args);

        $this->lotteryOptionService = app(LotteryOptionService::class);
    }

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
     */
    public function run(TokenInterface $token): GetLotteryDataTask|static
    {
        Log::channel()->info('getLotteryDataTask run');

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
     */
    private function executeService(TokenInterface $token): bool
    {
        // 在这里实现您的远程请求接口逻辑，例如发送 HTTP 请求
        $dataStore = $token->getInstance()->getDataStore();

        /**
         * @var Request $request
         */
        $request = $dataStore->getData('request');


        $lotteryManage = $request->lotteryManage();

        //上一期开奖号码                             //上一期号
//        $code = $lotteryManage->getLastCode($request->currentIssue = $lotteryManage->getLastIssue());

        $code = rand(1, 6).','.rand(1, 6).','.rand(1, 6);
        $request->currentIssue = time();

        //开奖总次数
        $request->lottery_count_rules ++;


        //匹配开奖选项 设置开奖规则 父节点title设置为 key
        $validateLotteryOption = $request->requestLotteryOption->filter(function (LotteryOption $item) use ($code) {

            return $this->lotteryOptionService->validateOptionWithParents($item, $code);
        })->each(function (LotteryOption $item) use ($request) {

            $request->appendLotteryRules($item->parentNode->title ?? $item->title, $item->value);
        });

        $betOrderLogBettingLogUpdateOrCreate = RequestLog::updateOrCreate(
            ['request_id' => $request->id, 'issue' => $request->currentIssue],
            ['lottery_code' => $code]
        );

        if (!$betOrderLogBettingLogUpdateOrCreate->wasRecentlyCreated && $betOrderLogBettingLogUpdateOrCreate->bet_code) {

            //是否中奖
            if ($optionInfo = $validateLotteryOption->where('value', $betOrderLogBettingLogUpdateOrCreate->bet_code)->first()) {
                //输赢规则
                $request->appendWinLoseRules(Request::WIN);
                $betOrderLogBettingLogUpdateOrCreate->win_lose = Request::WIN;

                //设置总投注金额 = 投注金额 * 选项赔率
                $request->totalAmountRulesIncrement($betOrderLogBettingLogUpdateOrCreate->bet_amount * $optionInfo->odds);
                $betOrderLogBettingLogUpdateOrCreate->bet_total_amount = $request->bet_total_amount_rules;

                $request->continuous_lose_count_rules = 0;
                $request->continuous_win_count_rules ++;

            } else {

                //输赢规则
                $request->appendWinLoseRules(Request::LOSE);
                $betOrderLogBettingLogUpdateOrCreate->win_lose = Request::LOSE;

                $request->continuous_win_count_rules = 0;
                $request->continuous_lose_count_rules ++;
            }
            //保持投注单日志表
            $betOrderLogBettingLogUpdateOrCreate->lottery_code = $code;
            $betOrderLogBettingLogUpdateOrCreate->save();
        }

        return true;
    }


}
