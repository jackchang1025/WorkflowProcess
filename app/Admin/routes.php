<?php


use App\Admin\Controllers\LotteryController;
use App\Admin\Controllers\LotteryGroupController;
use App\Admin\Controllers\LotteryOptionController;
use App\Admin\Controllers\ProcessController;
use App\Admin\Controllers\RequestController;
use App\Admin\Controllers\RequestLogController;
use App\Admin\Controllers\RequestStatisticsController;
use App\Admin\Controllers\RuleController;
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

//    preg_match('/([\x{4e00}-\x{9fa5}_a-zA-Z0-9])\1{2,}$/u', '小大小小小小小大小大小大小小小', $matches);
//
//    dd($matches);


//    $response = preg_match('/1$/', '1');
//
//    dd($response);

    ////AAA
    //function ($request){
    //return preg_match('/([\x{4e00}-\x{9fa5}_a-zA-Z0-9])\1{2,}/u', $request->lottery_rules);
    //}

//    preg_match('/([\x{4e00}-\x{9fa5}_a-zA-Z0-9])\1{2,}$/u', '小小大大大大小小小小小小', $matches);
//
//    throw_if(empty($response), new Exception('获取投注号码失败'));
////我们计算匹配字符串的长度，然后根据这个长度来设置 $number 的值。我们减去2是因为我们的匹配规则是从3个字符开始的，所以3个字符对应的 $number 是1，4个字符对应的是2
//    $number = mb_strlen($matches[0]) - 2;
//
////设置投注金额
//    $current_bet_amount_rule = 10 * $number;
//    dd($matches,time());






    $router->get('/', 'HomeController@index');

    Route::resource('request', RequestController::class);

    Route::post('process/run', [ProcessController::class, 'run'])->name('process.run');

    Route::get('process/dispatch/{id}', [ProcessController::class, 'dispatch'])->name('process.dispatch');

    Route::get('request_statistics/getData/{id}', [RequestStatisticsController::class, 'getData'])->name('request_statistics.getData');
    Route::get('request_statistics/show/{id}', [RequestStatisticsController::class, 'show'])->name('request_statistics.show');

    Route::resource('process', ProcessController::class);
    Route::resource('request_log', RequestLogController::class);
    Route::resource('lottery_group', LotteryGroupController::class);
    Route::resource('lottery', LotteryController::class);
    Route::resource('token', TokenController::class);
    Route::resource('lottery_option', LotteryOptionController::class);
    Route::resource('rule', RuleController::class);
});
