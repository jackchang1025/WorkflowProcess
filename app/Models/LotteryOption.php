<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Dcat\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\LotteryOption
 *
 * @property int $id
 * @property int $parent_id 分类id
 * @property string $title 名称
 * @property int $status 状态
 * @property int $order 排序
 * @property string|null $rule 规则
 * @property float|null $odds 赔率
 * @property string|null $value 值
 * @property string|null $description 描述
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryOption ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryOption whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryOption whereOdds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryOption whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryOption whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryOption whereRule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryOption whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryOption whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryOption whereValue($value)
 * @property-read LotteryOption|null $allParentNodeNode
 * @property-read LotteryOption|null $parentNode
 * @mixin \Eloquent
 */
class LotteryOption extends Model
{
    use HasDateTimeFormatter;
    use  ModelTree {
        ModelTree::boot as treeBoot;
    }

    protected $fillable = [
        'parent_id',
        'title',
        'status',
        'order',
        'value',
        'rule',
        'odds',
    ];

    protected $table = 'lottery_option';

    /**
     * 父类节点
     * @return HasOne
     */
    public function parentNode(): HasOne
    {
        return $this->hasOne(static::class,'id','parent_id');
    }

    /**
     * 获取所有父类节点
     * @return HasOne
     */
    public function allParentNodeNode(): HasOne
    {
        return $this->parentNode()->with('allTopNode');
    }

}
