<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use ProcessMaker\Nayra\Bpmn\DataStoreTrait;
use ProcessMaker\Nayra\Contracts\Bpmn\DataStoreInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\ProcessInterface;
use ProcessMaker\Nayra\Contracts\Repositories\StorageInterface;
use ProcessMaker\Nayra\Contracts\RepositoryInterface;
use ProcessMaker\Nayra\Contracts\Storage\BpmnElementInterface;

/**
 * App\Models\Request
 *
 * @property int $id
 * @property string $bpmn_xml bpmn_xml
 * @property int $lottery_option_id lottery_option_id
 * @property int $lottery_id lottery_id
 * @property int $code_type 类型
 * @property int $status 状态
 * @property string|null $lottery_rules 开奖规则
 * @property int|null $lottery_count_rules 开奖总次数规则
 * @property int|null $bet_base_amount_rules 基础投注金额规则
 * @property int|null $bet_total_amount_rules 总投注金额规则
 * @property string|null $bet_amount_rules 投注金额规则
 * @property string|null $bet_code_rules 投注号码规则
 * @property int|null $bet_count_rules 投注次数规则
 * @property string|null $win_lose_rules 输赢规则
 * @property int|null $continuous_lose_count_rules 连续输次数规则
 * @property int|null $continuous_win_count_rules 连续赢次数规则
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Request newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Request newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Request query()
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereBetAmountRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereBetBaseAmountRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereBetCodeRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereBetCountRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereBetTotalAmountRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereBpmnXml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereCodeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereContinuousLoseCountRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereContinuousWinCountRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereLotteryCountRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereLotteryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereLotteryOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereLotteryRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereWinLoseRules($value)
 * @property int|null $token_id token id
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereTokenId($value)
 * @mixin \Eloquent
 */
class Request extends Model
{
    use HasDateTimeFormatter;

    protected $fillable = [
        'bpmn_xml',
        'lottery_option_id',
        'lottery_id',
        'code_type',
        'status',
        'lottery_rules',
        'lottery_count_rules',
        'bet_base_amount_rules',
        'bet_total_amount_rules',
        'bet_amount_rules',
        'bet_code_rules',
        'bet_count_rules',
        'win_lose_rules',
        'continuous_lose_count_rules',
        'continuous_win_count_rules'
    ];

    protected $table = 'request';

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

    const CODE_TYPE_LOCAL = 1;
    const CODE_TYPE_PRODUCTION = 2;
    const CODE_TYPE_HISTORY = 3;

    static array $codeType = [
        self::CODE_TYPE_LOCAL      => '测试数据',
        self::CODE_TYPE_PRODUCTION => '实时数据',
        self::CODE_TYPE_HISTORY    => '历史数据',
    ];

    /**
     * 彩票选项
     * @return BelongsToMany
     */
    public function requestLotteryOption(): BelongsToMany
    {
        return $this->belongsToMany(LotteryOption::class, 'request_lottery_option', 'request_id', 'lottery_option_id');
    }

    public function lottery(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Lottery::class);
    }

    public function requestLog(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RequestLog::class);
    }
}
