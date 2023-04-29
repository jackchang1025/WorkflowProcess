<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\RequestLog;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class RequestLogController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new RequestLog(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('request_id');
            $grid->column('issue');
            $grid->column('bet_code');
            $grid->column('bet_code_odds');
            $grid->column('lottery_code');
            $grid->column('bet_amount');
            $grid->column('bet_total_amount');
            $grid->column('win_lose');
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
        return Show::make($id, new RequestLog(), function (Show $show) {
            $show->field('id');
            $show->field('request_id');
            $show->field('issue');
            $show->field('bet_code');
            $show->field('bet_code_odds');
            $show->field('lottery_code');
            $show->field('bet_amount');
            $show->field('bet_total_amount');
            $show->field('win_lose');
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
        return Form::make(new RequestLog(), function (Form $form) {
            $form->display('id');
            $form->text('request_id');
            $form->text('issue');
            $form->text('bet_code');
            $form->text('bet_code_odds');
            $form->text('lottery_code');
            $form->text('bet_amount');
            $form->text('bet_total_amount');
            $form->text('win_lose');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
