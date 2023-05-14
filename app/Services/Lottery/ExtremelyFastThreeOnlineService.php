<?php

namespace App\Services\Lottery;

class ExtremelyFastThreeOnlineService extends ExtremelyFastThreeService
{

    /**
     * 投注
     * @param int $issue
     * @param string $betCode
     * @param float $betAmount
     * @return bool
     */
    public function lotteryBet(int $issue, string $betCode, float $betAmount): bool
    {
        return true;
    }
}
