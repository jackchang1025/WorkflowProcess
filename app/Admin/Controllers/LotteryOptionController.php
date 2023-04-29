<?php

namespace App\Admin\Controllers;

use App\Models\LotteryOption;
use App\Models\LotteryOption as LotteryOptionModel;
use Dcat\Admin\Form;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Tree;

class LotteryOptionController extends AdminController
{

    public function index(Content $content)
    {
        return $content
            ->title($this->title())
            ->description(trans('admin.list'))
            ->body($this->treeView());
    }

    /**
     * @return Tree
     */
    protected function treeView(): Tree
    {
        return new Tree(new LotteryOption(), function (Tree $tree) {
            $tree->disableCreateButton();
            $tree->disableEditButton();

            $tree->branch(function ($branch) {

                $branchName = htmlspecialchars($branch['title']);

                $branchSlug = htmlspecialchars($branch['rule']);

                return "
<div class='pull-left' style='min-width:310px'><b>{$branchName}</b>&nbsp;&nbsp;
[规则:<span class='text-primary'>{$branchSlug}</span>]&nbsp;&nbsp;
[赔率:<span class='text-primary'>{$branch['odds']}</span>]&nbsp;&nbsp;
[值:<span class='text-primary'>{$branch['value']}</span>]&nbsp;&nbsp;
</div>&nbsp;";
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        return Form::make(LotteryOptionModel::make(),function (Form $form){

            $form->display('id');
            $form->text('title')->required();
            $form->select('parent_id')->options(LotteryOptionModel::selectOptions())
                ->saving(function ($value){
                    return (int) $value;
                });

            $form->textarea('rule')->help("设置正则表达式匹配开奖号码,子类会基层父类匹配规则");
            $form->text('value');
            $form->rate('odds')->default(0);
            $form->number('order');
            $form->switch('status')->default(1);
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
