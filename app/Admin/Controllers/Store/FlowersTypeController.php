<?php

namespace App\Admin\Controllers\Store;

use App\Model\FlowersType;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class FlowersTypeController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(FlowersType::class, function (Grid $grid) {

            $grid->model()->OrderBy('created_at','desc');


            $grid->id('ID')->sortable();
            $grid->column('title','分类名称');
            $grid->column('content','描述');
            $grid->created_at('创建时间');
            $grid->column('status','状态')
                ->switch([
                    'on'=>['text'=>'启用'],
                    'off'=>['text'=>'禁用']
                ]);
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(FlowersType::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title','分类名称')
                ->rules(['required'],['required'=>'请输入名称']);
            $form->text('content','描述');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
