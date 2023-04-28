<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use ProcessMaker\Nayra\Contracts\Bpmn\DataStoreInterface;

/**
 * App\Models\Process
 *
 * @property int $id
 * @property string $title 名称
 * @property string $bpmn_xml bpmn_xml
 * @property int $status 状态
 * @property int $order 状态
 * @property string|null $describe 描述
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Process newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Process newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Process query()
 * @method static \Illuminate\Database\Eloquent\Builder|Process whereBpmnXml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Process whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Process whereDescribe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Process whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Process whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Process whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Process whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Process whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Process extends Model
{
    use HasDateTimeFormatter;

    protected $fillable = [
        'title',
        'bpmn_xml',
        'status',
    ];
}
