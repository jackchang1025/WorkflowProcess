<?php

namespace App\Admin\Controllers;

use App\Models\Request;
use App\Models\RequestLog;
use App\Models\Rule;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Illuminate\Support\Facades\Response;


class RequestStatisticsController extends AdminController
{
    public function show($id, Content $content)
    {

        $request = Request::with(['requestLog:issue,bet_amount,bet_total_amount,bet_code,lottery_code,bet_code_transform_value,win_lose,request_id'])->find($id);

        $requestLogs = $request->requestLog->unique('issue')->values();

        $x = 1.5;
        $y = 0.5;
        $lastResult = null;

        foreach ($requestLogs as $key => $log) {
            if ($key == 0) {
                // 对于第一个元素，我们直接设定它的 x 和 y 值为 1
                $requestLogs[$key]['x'] = $x;
                $requestLogs[$key]['y'] = $y;
            } else {
                // 对于后续的元素，我们需要检查它的 bet_code_transform_value 值是否与前一个元素一致
                if ($log['bet_code_transform_value'] == $lastResult) {
                    // 如果一致，那么它的 x 值与前一个元素相同，y 值增加
                    $y++;
                    $requestLogs[$key]['x'] = $x;
                    $requestLogs[$key]['y'] = $y;
                } else {
                    // 如果不一致，那么我们创建一个新的列（即增加 x 值），并且 y 值重置为 1
                    $x += 1;
                    $y = 0.5;
                    $requestLogs[$key]['x'] = $x;
                    $requestLogs[$key]['y'] = $y;
                }
            }

            // 根据 bet_code_transform_value 值设定颜色
            $requestLogs[$key]['color'] = Request::$lotteryOptionValue[$log->bet_code_transform_value] ?? 'yellow';

            // 更新 lastResult 变量，以便下一次循环使用
            $lastResult = $log['bet_code_transform_value'];
        }

        $request->total_lottery_count = $requestLogs->count();
        $request->win_count           = $requestLogs->where('bet_code', '!=', '')->where('win_lose', Request::WIN)->count();
        $request->lose_count          = $requestLogs->where('bet_code', '!=', '')->where('win_lose', Request::LOSE)->count();
        $request->bet_count           = $requestLogs->where('bet_code', '!=', '')->whereIn('win_lose', [Request::WIN, Request::LOSE])->count();


        $ruleList = Rule::where('status', 1)->get();

        $ruleList->each(function (Rule $rule) use ($request) { #/([\x{4e00}-\x{9fa5}])\1{2}/u

            $count = preg_match_all($rule->rule, $request->lottery_rules, $matches);

            $rule->rule_count = $count;
        })->makeHidden(['created_at', 'updated_at', 'status']);

        Admin::js('echarts/echarts-5.4.2.js');

        return $content
            ->title('Request Statistics')
            ->description('description')
            ->row(function (Row $row) use ($request) {

                $row->column(6, view('requestStatistics/request_total_count_statistics', [
                    'data' => [
                        'request' => $request
                    ]
                ]));

                $row->column(6, view('requestStatistics/request_win_lose_statistics', [
                    'data' => [
                        'request' => $request
                    ]
                ]));
            })
            ->row(function (Row $row) use ($ruleList) {
                $row->column(12, view('requestStatistics/request_statistics_rule', [
                    'data' => [
                        'ruleList' => $ruleList
                    ]
                ]));
            })
            ->row(function (Row $row) use ($requestLogs) {
                $row->column(12, view('requestStatistics/request_statistics', [
                    'data' => [
                        'requestLogs' => $requestLogs
                    ]
                ]));
            })->row(function (Row $row) use ($requestLogs){
                $row->column(12, view('requestStatistics/request_statistics_lutu', [
                    'data' => [
                        'requestLogs' => $requestLogs
                    ]
                ]));
            });
    }

    public function getData($id): \Illuminate\Http\JsonResponse
    {
        $requestLog = RequestLog::where('request_id', $id)->get();

        return Response::success('创建成功', $requestLog);
    }
}
