<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RequestLog
 *
 * @property int $id
 * @property int $request_id request_id
 * @property string $issue 期号
 * @property string $bet_code 投注号码
 * @property float $bet_code_odds 投注号码赔率
 * @property string $lottery_code 开奖号码
 * @property int $bet_amount 投注金额
 * @property int $bet_total_amount 投注总金额
 * @property int $win_lose 输赢
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereBetAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereBetCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereBetCodeOdds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereBetTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereIssue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereLotteryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereWinLose($value)
 * @mixin \Eloquent
 */
class RequestLog extends Model
{
	use HasDateTimeFormatter;

    protected $table = 'request_log';

}