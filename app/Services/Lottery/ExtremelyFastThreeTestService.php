<?php

namespace App\Services\Lottery;

use App\Services\Lottery\LotteryInterFace;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

class ExtremelyFastThreeTestService extends AbstractLotteryService implements LotteryInterFace
{
    protected Collection $lottery;

    /**
     * @param string $urlAddress
     * @param string $token
     * @param int $lotteryId
     * @param string $version
     * @throws \Throwable
     */
    public function __construct(string $urlAddress, string $token, int $lotteryId, string $version = '1.0')
    {
        parent::__construct($urlAddress,  $token, $lotteryId,$version);

        $lotteryHistoryOpenInfo = $this->lotteryHistoryOpenInfo(5000);

        throw_if(empty($lotteryHistoryOpenInfo['data']['historyList']),new Exception('获取彩票数据为空'));

        $this->lottery = collect($lotteryHistoryOpenInfo['data']['historyList']);
    }

    /**
     * 获取最后一期数据
     * @return mixed
     * @throws Exception|\Throwable
     */
    public function lotteryLastInfo(): mixed
    {
        return $this->lottery->pop();
    }


    /**
     * 获取当前期数信息
     * @return mixed
     * @throws \Throwable
     */
    public function lotteryCurrentInfo(): mixed
    {
        return $this->lottery->last();
    }


    public function beginTime(): int
    {
        return time();
    }

    /**
     * 当前期数结束时间
     * @return int
     * @throws
     */
    public function endTime(): int
    {
        return time();
    }

    /**
     * 当前是否可以投注
     * @return bool
     */
    public function isCurrentBet(): bool
    {
        return true;
    }

    public function payload(string $code): mixed
    {
        return false;
    }

    public function lotteryBet(int $issue, string $betCode, float $betAmount): bool
    {
        return true;
    }

    public function sleep(): int
    {
        return 0.1;
    }
}
