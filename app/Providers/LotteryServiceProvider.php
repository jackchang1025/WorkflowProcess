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
    protected ?LotteryInterFace $lotteryService = null;

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(LotteryServiceProvider::class, function (Application $app, array $params) {
            // 根据参数中的 code_type，实例化不同的服务类

            if (!$this->lotteryService) {
                if ($params['code_type'] == Request::CODE_TYPE_HISTORY) {
                    $this->lotteryService = new ExtremelyFastThreeTestService(
                        $params['url_address'],
                        $params['token'],
                        $params['lottery_id'],
                        $params['version']
                    );
                }else{

                    $this->lotteryService = new ExtremelyFastThreeService(
                        $params['url_address'],
                        $params['token'],
                        $params['lottery_id'],
                        $params['version']
                    );
                }


            }

            return $this->lotteryService;
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
