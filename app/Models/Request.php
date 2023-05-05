<?php

namespace App\Models;

use App\Providers\LotteryServiceProvider;
use App\Services\Lottery\LotteryInterFace;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


/**
 * App\Models\Request
 *
 * @property int $id
 * @property string $bpmn_xml bpmn_xml
 * @property string $title 名称
 * @property int $lottery_option_id lottery_option_id
 * @property int $lottery_id lottery_id
 * @property int $code_type 类型
 * @property string $status 状态
 * @property array $lottery_rules 开奖规则
 * @property int|null $lottery_count_rules 开奖总次数规则
 * @property int|null $bet_base_amount_rules 基础投注金额规则
 * @property int|null $bet_total_amount_rules 总投注金额规则
 * @property int|null $total_amount_rules 总金额规则
 * @property string|null $bet_amount_rules 投注金额规则
 * @property string|null $bet_code_rules 投注号码规则
 * @property int|null $bet_count_rules 投注次数规则
 * @property string|null $win_lose_rules 输赢规则
 * @property int|null $continuous_lose_count_rules 连续输次数规则
 * @property int|null $continuous_win_count_rules 连续赢次数规则
 * @property string|null $current_bet_code_rule 当前投注号码规则
 * @property int|null $current_bet_amount_rule 当前投注金额规则
 * @property string|null $current_issue 当前期号
 * @property string|null $last_issue 上一期号
 * @property int|null $token_id token id
 * @property-read int|null $request_lottery_option_count
 * @property-read int|null $request_log_count
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
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereTokenId($value)
 * @property-read \App\Models\Lottery|null $lottery
 * @property-read \App\Models\Token|null $token
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestLog> $requestLog
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LotteryOption> $requestLotteryOption
 * @mixin \Eloquent
 */
class Request extends Model
{

    protected LotteryInterFace $lotteryService;

    use HasDateTimeFormatter;

    protected $fillable = [
        'bpmn_xml',
        'title',
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
        'continuous_win_count_rules',
        'current_bet_code_rule',
        'current_bet_amount_rule',
        'current_issue',
        'last_issue',
    ];

    protected $attributes = [
//        'lottery_rules' => [],
'win_lose_rules' => '1',
    ];

    protected $casts = [
        'lottery_rules' => 'json',
    ];

    // 定义需要排除的字段
    protected array $excludeFieldsOnSave = [

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


    const LOSE = 0;
    const WIN = 1;
    const AND = 3;
    static array $winOrLost = [
        self::WIN  => '赢',
        self::LOSE => '输',
        self::AND  => '和',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';
    const STATUS_RUNNING = 'running';
    const STATUS_STOP = 'stop';

    static array $status = [
        self::STATUS_PENDING   => '执行中',
        self::STATUS_COMPLETED => '已完成',
        self::STATUS_FAILED    => '执行失败',
        self::STATUS_RUNNING    => '执行中',
        self::STATUS_STOP    => '已停止',
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

    public function token(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Token::class);
    }

    public function requestLog(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RequestLog::class);
    }

    public function lotteryManage(): LotteryInterFace
    {
        return $this->lotteryService = app(LotteryServiceProvider::class, [
            'url_address' => $this->lottery->url,
            'token'       => $this->token->token,
            'lottery_id'  => $this->lottery->lottery_id,
            'version'     => $this->lottery->version,
            'code_type'   => $this->code_type,
        ]);
    }

    /**
     * 上一次投注金额
     * @return int|null
     */
    public function getLastBetAmountRulesAttribute(): ?int
    {
        if (empty($this->bet_amount_rules)) {
            return $this->bet_base_amount_rules;
        }

        $betAmountRules = explode(',', $this->bet_amount_rules);
        return $betAmountRules[count($betAmountRules) - 1];
    }

    /**
     * 添加开奖规则
     * @param string $key
     * @param $value
     * @return
     */
    public function appendLotteryRules(string $key, $value)
    {
        return $this->lottery_rules .= $value;

        $lotteryRules = $this->lottery_rules ?? [];

        empty($lotteryRules[$key]) ? $lotteryRules[$key] = $value : $lotteryRules[$key] .= $value;

        return $this->lottery_rules = $lotteryRules;
    }

    /**
     * 输赢规则
     * @param string $value
     * @return string
     */
    public function appendWinLoseRules(string $value): string
    {
        return $this->win_lose_rules .= $value;
    }

    /**
     * 总金额自减
     *
     * @param float|int $betAmount
     * @return float|int
     */
    public function totalAmountRulesDecrement(float|int $betAmount): float|int
    {
        return $this->bet_total_amount_rules -= $betAmount;
    }

    /**
     * 总金额自增
     *
     * @param float|int $betAmount
     * @return float|int
     */
    public function totalAmountRulesIncrement(float|int $betAmount): float|int
    {
        return $this->bet_total_amount_rules += $betAmount;
    }

    public function save(array $options = [])
    {
        // 在保存之前移除排除字段
        foreach ($this->excludeFieldsOnSave as $field) {
            unset($this->$field);
        }

        // 调用父类的 save() 方法
        return parent::save($options);
    }

}
