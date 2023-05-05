<?php

namespace App\Providers;

use App\Models\Request;
use App\Services\Lottery\ExtremelyFastThreeService;
use App\Services\Lottery\ExtremelyFastThreeTestService;
use App\Services\Lottery\LotteryInterFace;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class LotteryServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(LotteryServiceProvider::class, function (Application $app, array $params) {
            // 根据参数中的 code_type，实例化不同的服务类

            if ($params['code_type'] == Request::CODE_TYPE_HISTORY) {

                return new ExtremelyFastThreeTestService(
                    $params['url_address'],
                    $params['token'],
                    $params['lottery_id'],
                    $params['version']
                );

            }else{

                return new ExtremelyFastThreeService(
                    $params['url_address'],
                    $params['token'],
                    $params['lottery_id'],
                    $params['version']
                );
            }
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
