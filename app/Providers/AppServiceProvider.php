<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
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
    }
}
