<?php


use App\Admin\Controllers\LotteryController;
use App\Admin\Controllers\LotteryGroupController;
use App\Admin\Controllers\LotteryOptionController;
use App\Admin\Controllers\ProcessController;
use App\Admin\Controllers\RequestController;
use App\Admin\Controllers\RequestLogController;
use App\Admin\Controllers\TokenController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;


Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    Route::resource('request', RequestController::class);

    Route::post('process/run', [ProcessController::class, 'run'])->name('process.run');
    Route::get('process/dispatch/{id}', [ProcessController::class, 'dispatch'])->name('process.dispatch');

    Route::resource('process', ProcessController::class);
    Route::resource('request_log', RequestLogController::class);
    Route::resource('lottery_group', LotteryGroupController::class);
    Route::resource('lottery', LotteryController::class);
    Route::resource('token', TokenController::class);
    Route::resource('lottery_option', LotteryOptionController::class);
});
