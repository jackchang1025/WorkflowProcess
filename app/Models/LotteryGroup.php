<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Dcat\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LotteryGroup
 *
 * @property int $id
 * @property string $title 名称
 * @property int $parent_id 父类id
 * @property int $order 排序
 * @property int $status 状态
 * @property string $driver_type 类型
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryGroup whereDriverType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryGroup whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryGroup whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryGroup whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryGroup whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryGroup ordered(string $direction = 'asc')
 * @mixin \Eloquent
 */
class LotteryGroup extends Model
{
	use HasDateTimeFormatter, ModelTree;
    protected $table = 'lottery_group';

    const EXTREMELY_FAST_THREE = 'extremelyFastThree';
    const WEB_SOCKET_CLIENT = 'web_socket_client';

    static array $driver = [
        self::EXTREMELY_FAST_THREE=>'极速快三',
        self::WEB_SOCKET_CLIENT=>'web socket client',
    ];

}
