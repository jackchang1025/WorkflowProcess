<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\LotteryGroup;
use App\Models\Lottery as LotteryModel;
use App\Models\LotteryGroup as LotteryGroupModel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Tree;
use Dcat\Admin\Widgets\Box;
use Dcat\Admin\Widgets\Form as WidgetForm;

class LotteryGroupController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content->title($this->title)
            ->description(trans('LotteryGroup'))
            ->body(function (Row $row){
                $tree = new Tree(new LotteryGroup());
                $tree->disableCreateButton();
                $tree->disableQuickCreateButton();
                $tree->disableEditButton();

                $tree->branch(function ($branch) {
                    return $branch['title'];
                });

                $row->column(7,$tree);

                $row->column(5, function (Column $column) {
                    $form = new WidgetForm();
                    $form->action(admin_url('lottery_group'));

                    $form->text('title')->required();
                    $form->select('parent_id')->options(LotteryGroupModel::selectOptions());
                    $form->select('driver_type')->options(LotteryGroupModel::$driver)->help('彩票驱动类型 driver')->required();
                    $form->number('order');
                    $form->switch('status')->default(1);

                    $form->width(9, 2);
                    $column->append(Box::make(trans('admin.new'), $form));
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
        return Show::make($id, new LotteryGroup(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('parent_id');
            $show->field('order');
            $show->field('status');
            $show->field('driver_type');
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
        return Form::make(new LotteryGroup(), function (Form $form) {
            $form->display('id');
            $form->text('title')->required();


            $form->select('parent_id')->options(function (){
                return LotteryGroupModel::selectOptions();
            })->saving(function ($value){
                return (int) $value;
            });

            $form->select('driver_type')->options(LotteryGroupModel::$driver)->help('彩票驱动类型 driver')->required();

            $form->number('order');
            $form->switch('status');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
