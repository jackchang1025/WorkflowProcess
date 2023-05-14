<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($message = 'success',$data = [], $code = 200, $status = 'success') {
            return Response::json([
                'status'  => $status,
                'code'    => $code,
                'message' => $message,
                'data'    => $data,
            ], $code);
        });

        Response::macro('error', function ($message = 'success', $data = [], $code = 200, $status = 'error') {
            return Response::json([
                'status'  => $status,
                'code'    => $code,
                'message' => $message,
                'data'    => $data,
            ], $code);
        });

        Validator::extend('str_replace', 'App\Rules\LotteryOptionRule@str_replace');
        Validator::extend('explode', 'App\Rules\LotteryOptionRule@explode');
        Validator::extend('array_sum', 'App\Rules\LotteryOptionRule@array_sum');
        Validator::extend('pregMatch', 'App\Rules\LotteryOptionRule@pregMatch');
        Validator::extend('substr', 'App\Rules\LotteryOptionRule@substr');
        Validator::extend('determineResultVillage', 'App\Rules\LotteryOptionRule@determineResultVillage');
        Validator::extend('determineResultIdle', 'App\Rules\LotteryOptionRule@determineResultIdle');
        Validator::extend('determineResultAnd', 'App\Rules\LotteryOptionRule@determineResultAnd');
    }
}
