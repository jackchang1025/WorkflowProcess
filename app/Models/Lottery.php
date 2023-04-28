<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Lottery
 *
 * @property int $id
 * @property int $lottery_group_id
 * @property string $title
 * @property string $code
 * @property int $period
 * @property int $period_interval
 * @property string $url
 * @property int $length
 * @property string $version
 * @property int $status
 * @property int $order
 * @property string $start_time
 * @property string $end_time
 * @property string|null $describe
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereDescribe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereLotteryGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery wherePeriodInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereVersion($value)
 * @property int $lottery_id 接口彩票id
 * @property-read \App\Models\LotteryGroup|null $lotteryGroup
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereLotteryId($value)
 * @mixin \Eloquent
 */
class Lottery extends Model
{
    use HasDateTimeFormatter;

    //开奖规则
    const LOTTERY_RULES = 'lottery_rules';
    //开奖次数规则
    const LOTTERY_COUNT_RULES = 'lottery_count_rules';

    //基础投注金额规则
    const BET_BASE_AMOUNT_RULES = 'bet_base_amount_rules';
    //总投注金额规则
    const BET_TOTAL_AMOUNT_RULES = 'bet_total_amount_rules';
    //投注金额规则
    const BET_AMOUNT_RULES = 'bet_amount_rules';

    //投注号码规则
    const BET_CODE_RULES = 'bet_code_rules';
    //投注次数数规则
    const BET_COUNT_RULES = 'bet_count_rules';
    //输赢规则
    const WIN_LOSE_RULES = 'win_lose_rules';
    //连续输次数规则
    const CONTINUOUS_LOSE_COUNT_RULES = 'continuous_lose_count_rules';
    //连续赢次数规则
    const CONTINUOUS_WIN_COUNT_RULES = 'continuous_win_count_rules';

    protected $table = 'lottery';

    public function lotteryGroup(): BelongsTo
    {
        return $this->belongsTo(LotteryGroup::class);
    }

}
