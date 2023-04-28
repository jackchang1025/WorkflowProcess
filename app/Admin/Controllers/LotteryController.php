<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Lottery;
use App\Models\Lottery as LotteryModel;
use App\Models\LotteryGroup;
use App\Models\LotteryOption;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Database\Eloquent\Model;

class LotteryController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Lottery('lotteryGroup'), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('lottery_group.title')->label();
            $grid->column('code');
            $grid->column('length');
            $grid->column('period');
            $grid->column('period_interval');
            $grid->column('status')->switch();
            $grid->column('order');
            $grid->column('start_time');
            $grid->column('end_time');
            $grid->column('describe');
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
        return Show::make($id, new Lottery(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('lottery_group_id');
            $show->field('code');
            $show->field('period');
            $show->field('period_interval');
            $show->field('status');
            $show->field('order');
            $show->field('start_time');
            $show->field('end_time');
            $show->field('describe');
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
        return Form::make(new Lottery(['lotteryGroup']), function (Form $form) {
            $form->display('id');
            $form->text('title')->required();
            $form->text('code')->help('彩票代码，唯一不重复')->required();
            $form->number('length')->help('彩票数字长度')->required();
            $form->text('url')->help('rul')->required();
            $form->number('lottery_id')->help('网站对应的彩票id')->required();
            $form->text('version')->help('version')->default('1.0')->required();
            $form->select('lottery_group_id')->options(function () {
                $selectOptions = LotteryGroup::selectOptions();
                unset($selectOptions[0]);
                return $selectOptions;
            })->saving(function ($value) {
                return (int)$value;
            });

            $form->number('period')->help('每日总共的期数')->required();
            $form->number('period_interval')->help('每期间隔的时间（秒）')->required();
            $form->number('order')->default(0);
            $form->switch('status')->default(1);
            $form->time('start_time')->required();
            $form->time('end_time')->required();
            $form->textarea('describe');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
