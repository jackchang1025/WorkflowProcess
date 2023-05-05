<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Rule;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class RuleController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Rule(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('status')->switch();
            $grid->column('type');
            $grid->column('rule');
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
        return Show::make($id, new Rule(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('status');
            $show->field('type');
            $show->field('rule');
            $show->field('description');
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
        return Form::make(new Rule(), function (Form $form) {
            $form->display('id');
            $form->text('title')->required();
            $form->switch('status')->default(1)->required();
            $form->select('type');
            $form->textarea('rule')->required();
            $form->textarea('description');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
