<?php


namespace App\Services\Lottery;


interface LotteryInterFace
{
    /**
     * 上一期开奖信息
     * @return mixed
     */
    public function lotteryLastInfo();

    /**
     * 当前期开奖信息
     * @return mixed
     */
    public function lotteryCurrentInfo();

    /**
     * 历史开奖信息
     * @param int $number
     * @return mixed
     */
    public function lotteryHistoryOpenInfo(int $number);

    /**
     * 投注
     * @param int $issue
     * @param string $betCode
     * @param float $betAmount
     * @return mixed
     */
    public function lotteryBet(int $issue,string $betCode,float $betAmount);

    /**
     * 获取当前期数开奖时间
     * @return mixed
     */
    public function beginTime();

    /**
     * 获取当前期数结束时间
     * @return mixed
     */
    public function endTime();

    /**
     * 是否可以投注
     *
     * @return bool
     */
    public function isCurrentBet(): bool;

    /**
     * 距离下次开奖时间
     * @return mixed
     */
    public function sleep();

}
