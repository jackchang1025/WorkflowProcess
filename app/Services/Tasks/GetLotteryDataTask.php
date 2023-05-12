<?php

namespace App\Services\Tasks;

use App\Models\LotteryOption;
use App\Models\Request;
use App\Models\RequestLog;
use App\Services\Lottery\LotteryOptionService;
use App\Services\Traits\ServiceTrait;
use Illuminate\Support\Facades\Log;
use ProcessMaker\Nayra\Contracts\Bpmn\TokenInterface;

class GetLotteryDataTask
{
    use ServiceTrait;

    protected LotteryOptionService $lotteryOptionService;

    public function __construct()
    {
        $this->lotteryOptionService = app(LotteryOptionService::class);
    }

    /**
     * 服务任务执行器，用于执行服务任务的实现。这里的实现仅用于测试目的。这个方法尝试调用服务任务的实现，如果调用成功返回 true，否则返回 false。
     * @param TokenInterface $token
     * @return bool
     * @throws \Throwable
     */
    public function __invoke(TokenInterface $token): bool
    {

        $dataStore = $token->getInstance()->getDataStore();

        $request = Request::findOrStatusFail($dataStore->getData('request_id'));

        $lotteryManage = $dataStore->getData('lotteryManage');

        sleep($lotteryManage->sleep());

        $lotteryLastInfo = $lotteryManage->lotteryLastInfo();

        throw_if(!$lotteryLastInfo, new \Exception('获取上次开奖数据失败'));

        //上一期开奖号码
        $request->last_code = $code = $lotteryLastInfo['openNum'];
        //上一期号码
        $request->last_issue = $lotteryLastInfo['issue'];

        //开奖总次数
        $request->lottery_count_rules++;

        //设置默认值
        $request->win_lose_rules = $request->win_lose_rules ?: '1';


        //匹配开奖选项 设置开奖规则 父节点title设置为 key
        $validateLotteryOption = $request->requestLotteryOption->filter(function (LotteryOption $item) use ($code) {

            return $this->lotteryOptionService->validateOptionWithParents($item, $code);
        })->each(function (LotteryOption $item) use ($request) {

            $request->appendLotteryRules($item->parentNode->title ?? $item->title, $item->value);
        });

        $betOrderLogBettingLogUpdateOrCreate = RequestLog::updateOrCreate(
            ['request_id' => $request->id, 'issue' => $request->last_issue],
            ['lottery_code' => $code, 'bet_code_transform_value' => $validateLotteryOption->value('value'), 'bet_total_amount' => $request->bet_total_amount_rules]
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
                $request->continuous_win_count_rules++;

            } else {

                //输赢规则
                $request->appendWinLoseRules(Request::LOSE);
                $betOrderLogBettingLogUpdateOrCreate->win_lose = Request::LOSE;

                $request->continuous_win_count_rules = 0;
                $request->continuous_lose_count_rules++;
            }

            //保持投注单日志表
            $betOrderLogBettingLogUpdateOrCreate->lottery_code = $code;
            $betOrderLogBettingLogUpdateOrCreate->save();
        }

        Log::channel('ondemand')->info('GetLotteryDataTask 任务执行成功', ['App\Models\Request' => $request->toArray()]);
        return $request->save();
    }
}
