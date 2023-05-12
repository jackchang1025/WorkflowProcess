<?php

namespace App\Services\Lottery;

use Exception;
use Illuminate\Http\Client\Response;
use Throwable;

class ExtremelyFastThreeOnlineService extends ExtremelyFastThreeService
{

    /**
     * 投注
     * @param int $issue
     * @param string $betCode
     * @param float $betAmount
     * @return Response
     * @throws Exception|Throwable
     */
    public function lotteryBet(int $issue, string $betCode, float $betAmount): Response
    {
        return app(Response::class);
    }
}
