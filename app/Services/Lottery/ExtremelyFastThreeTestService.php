<?php

namespace App\Services\Lottery;

use App\Services\Lottery\IssueInterFace;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

class ExtremelyFastThreeTestService extends AbstractLotteryService implements IssueInterFace
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

        throw_unless(
            $this->lottery = !empty($lotteryHistoryOpenInfo['data']['historyList']) ? collect($lotteryHistoryOpenInfo['data']['historyList']) : null,
            new Exception('获取彩票数据为空'));
    }

    /**
     * 获取最后一期数据
     * @return mixed
     * @throws Exception|\Throwable
     */
    public function issueLastOpenInfo(): mixed
    {
        return $this->lastLottery ?: throw_unless($this->lastLottery = $this->lottery->pop(),new Exception('获取最后期号为空'));
    }

    /**
     * 获取最后期号
     * @return mixed|string
     * @throws \Throwable
     */
    public function getLastIssue(): mixed
    {
        return throw_unless($this->issueLastOpenInfo()['issue'] ?? false,new Exception('获取最后期号为空'));
    }

    /**
     * 获取最后开奖号码
     * @return mixed|string
     * @throws \Throwable
     */
    public function getLastCode(): mixed
    {
        return throw_unless($this->issueLastOpenInfo()['openNum'] ?? false,new Exception('获取最后开奖号码为空'));
    }

    /**
     * 获取当前期数信息
     * @return mixed
     * @throws \Throwable
     */
    public function lotteryCurrentInfo(): mixed
    {
        return $this->currentLottery ?: throw_unless($this->currentLottery = $this->lottery->last(),new Exception('获取当前期数信息为空'));
    }

    /**
     * 获取当前期数
     * @return int
     * @throws \Throwable
     */
    public function currentIssue(): int
    {
        return throw_unless($this->lotteryCurrentInfo()['issue'] ?? null,new Exception('获取当前期数为空'));
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
