<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Rule
 *
 * @property int $id
 * @property string $title 名称
 * @property int $status 状态
 * @property int|null $type 类型
 * @property string $rule 规则
 * @property string|null $description 描述
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Rule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rule query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rule whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rule whereRule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rule whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rule whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rule whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rule whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Rule extends Model
{
	use HasDateTimeFormatter;

    protected $table = 'rule';

}
