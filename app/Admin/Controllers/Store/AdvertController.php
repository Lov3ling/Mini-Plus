<?php

namespace App\Admin\Controllers\Store;

use App\Model\Advert;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AdvertController extends Controller
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
        return Admin::grid(Advert::class, function (Grid $grid) {
            $grid->model()->orderBy('created_at','desc','sort','desc');
            $grid->id('ID')->sortable();
            $grid->column('name','名称');
            $grid->column('url','跳转链接');
            $grid->column('sort','优先级');
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
        return Admin::form(Advert::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->text('name','名称')
                ->rules(['required'],['required'=>'请输入名称']);

            $form->image('image','图片')
                ->rules(['required'],['required'=>'请上传图片']);

            $form->text('url','跳转链接');

            $form->textarea('content','描述')->setWidth(8);

            $form->number('sort','优先级')->default(10);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
