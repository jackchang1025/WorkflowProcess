<?php


namespace App\Services\Lottery;


interface IssueInterFace
{
    public function issueLastOpenInfo();

    public function lotteryCurrentInfo();

    public function lotteryHistoryOpenInfo(int $number);

    public function lotteryBet(int $issue,string $betCode,float $betAmount);

    public function getLastIssue();

    public function getLastCode();

    public function beginTime();

    public function endTime();

    public function isCurrentBet(): bool;

    public function currentIssue();

    public function sleep();

}
