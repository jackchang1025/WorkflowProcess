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

    public function __construct(protected readonly LotteryOptionService $lotteryOptionService)
    {
    }

    /**
     * @param TokenInterface $token
     * @return bool
     * @throws \Throwable
     */
    public function __invoke(TokenInterface $token): bool
    {
        $dataStore     = $token->getInstance()->getDataStore();
        $request       = $this->getRequest($dataStore);
        $lotteryManage = $dataStore->getData('lotteryManage');

        sleep($lotteryManage->sleep());

        $lotteryLastInfo = $lotteryManage->lotteryLastInfo();

        throw_if(!$lotteryLastInfo, new \Exception('获取上次开奖数据失败'));

        $this->updateRequestWithLotteryInfo($request, $lotteryLastInfo);

        $this->updateRequestWithLotteryOption($request);

        Log::channel('ondemand')->info('GetLotteryDataTask 任务执行成功', ['App\Models\Request' => $request->toArray()]);
        return $request->save();
    }

    /**
     * 接收一个数据存储对象，并从中找到并返回对应的请求。
     * @param $dataStore
     * @return Request
     * @throws \Throwable
     */
    protected function getRequest($dataStore): Request
    {
        return Request::findOrStatusFail($dataStore->getData('request_id'));
    }

    /**
     * 这个方法接收一个请求对象和彩票的最后信息，然后更新请求的彩票信息。
     * @param Request $request
     * @param array $lotteryLastInfo
     * @return void
     */
    protected function updateRequestWithLotteryInfo(Request $request, array $lotteryLastInfo): void
    {
        $request->last_code  = $lotteryLastInfo['openNum'];
        $request->last_issue = $lotteryLastInfo['issue'];
        $request->lottery_count_rules++;
        $request->win_lose_rules = $request->win_lose_rules ?: '1';
    }

    /**
     * 这个方法接收一个请求对象，然后更新请求的彩票选项。
     * @param Request $request
     * @return void
     */
    protected function updateRequestWithLotteryOption(Request $request): void
    {
        $validateLotteryOption = $request->requestLotteryOption->filter(function (LotteryOption $item) use ($request) {
            return $this->lotteryOptionService->validateOptionWithParents($item, $request->last_code);
        })->each(function (LotteryOption $item) use ($request) {
            $request->appendLotteryRules($item->parentNode->title ?? $item->title, $item->value);
        });

        $betOrderLogBettingLogUpdateOrCreate = RequestLog::updateOrCreate(
            ['request_id' => $request->id, 'issue' => $request->last_issue],
            ['lottery_code' => $request->last_code, 'bet_code_transform_value' => $validateLotteryOption->value('value'), 'bet_total_amount' => $request->bet_total_amount_rules]
        );

        if (!$betOrderLogBettingLogUpdateOrCreate->wasRecentlyCreated && $betOrderLogBettingLogUpdateOrCreate->bet_code) {
            $this->updateRequestWithBetOrderLog($request, $betOrderLogBettingLogUpdateOrCreate, $validateLotteryOption);
        }
    }

    /**
     * 这个方法接收一个请求对象，一个投注订单日志对象和验证的彩票选项，然后根据验证的彩票选项更新请求和投注订单日志。
     * @param Request $request
     * @param RequestLog $betOrderLogBettingLogUpdateOrCreate
     * @param $validateLotteryOption
     * @return void
     */
    protected function updateRequestWithBetOrderLog(Request $request, RequestLog $betOrderLogBettingLogUpdateOrCreate, $validateLotteryOption): void
    {
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
        $betOrderLogBettingLogUpdateOrCreate->lottery_code = $request->last_code;
        $betOrderLogBettingLogUpdateOrCreate->save();
    }
}
