<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Request;
use App\Jobs\RequestJob;
use App\Models\Lottery;
use App\Models\LotteryOption;
use App\Models\Process;
use App\Models\Token;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class RequestController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Request(['lottery']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('lottery.title', '彩票')->label();

            $grid->column('code_type')->display(function ($value) {
                return \App\Models\Request::$codeType[$value] ?? '';
            })->label();

            $grid->column('status')->display(function ($value) {
                return $value == 1 ? '执行中' : '执行完成';
            })->label();

            $grid->column('lottery_count_rules');
            $grid->column('bet_base_amount_rules');
            $grid->column('bet_total_amount_rules');
            $grid->column('bet_count_rules');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Request(), function (Show $show) {
            $show->field('id');
            $show->field('bpmn_xml');
            $show->field('lottery_option_id');
            $show->field('lottery_id');
            $show->field('code_type');
            $show->field('status');
            $show->field('lottery_rules');
            $show->field('lottery_count_rules');
            $show->field('bet_base_amount_rules');
            $show->field('bet_total_amount_rules');
            $show->field('bet_amount_rules');
            $show->field('bet_code_rules');
            $show->field('bet_count_rules');
            $show->field('win_lose_rules');
            $show->field('continuous_lose_count_rules');
            $show->field('continuous_win_count_rules');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Request(['requestLotteryOption']), function (Form $form) {
            $form->display('id');

            $form->select('lottery_id')->options(function () {
                return Lottery::all()->pluck('title', 'id');
            })->saving(function ($value) {
                return (int)$value;
            })->required();

            $form->select('bpmn_xml')->options(function () {
                return Process::all()->pluck('title', 'id');
            })->saving(function ($value) {
                return $value;
            })->required();

            $form->select('code_type')->options(\App\Models\Request::$codeType)->required();

            $form->select('token_id')->options(function () {
                return Token::all()->pluck('title', 'id');
            })->saving(function ($value) {
                return (int)$value;
            })->rules('required_if:code_type,1,2');


            $form->tree('requestLotteryOption', '选项')
                ->nodes(LotteryOption::all()->toArray()) // 设置所有节点
                ->setTitleColumn('title')
                ->customFormat(function ($v) { // 格式化外部注入的值
                    if (!$v) return [];
                    return array_column($v, 'id');
                })->required();

            $form->switch('status')->default(1);

            $form->number('bet_base_amount_rules')->rules(['required', 'numeric', 'min:2', 'lt:bet_total_amount_rules',])->required();
            $form->number('bet_total_amount_rules')->rules('required|min:10|numeric')->required();

            $form->display('created_at');
            $form->display('updated_at');

            $form->saved(function (Form $form,$result) {

                RequestJob::dispatchSync($result->id);
            });
        });
    }
}
