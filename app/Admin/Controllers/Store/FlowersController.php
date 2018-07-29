<?php

namespace App\Admin\Controllers\Store;

use App\Model\Flowers;

use App\Model\FlowersType;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class FlowersController extends Controller
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
        return Admin::grid(Flowers::class, function (Grid $grid) {

            //时间排序
            $grid->model()->OrderBy('created_at','desc');

            //设置过滤字段
            $grid->filter($this->filter());

            $grid->id('ID')->sortable();
            $grid->column('image','预览')->image('',50,50);
            $grid->column('name','名称');
            $grid->column('type_id','分类')->display(function ($value){
               return FlowersType::find($value)->title;
            });
            $grid->column('original_price','原价');
            $grid->column('price','现价');
            $grid->column('nums','库存剩余');
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


        return Admin::form(Flowers::class, function (Form $form) {

            //获取分类列表
            $type_list=FlowersType::where(['status'=>1])
                ->get()
                ->pluck('title','id');

            $form->display('id', 'ID');

            $form->text('name','名称')
                ->rules(['required'],['required'=>"请输入名称"]);

            $form->image('image','图片')
                ->rules(['required'],['required'=>'请上传图片']);

            $form->select('type_id','选择分类')
                ->options($type_list)
                ->default(0)
                ->rules(['required'],['required'=>"请选择分类"]);

            $form->currency('original_price','现价')
                ->symbol('￥')
                ->default(0);

            $form->currency('price','现价')
                ->symbol('￥')
                ->default(0);

            $form->textarea('mean','花语')
                ->rules(['required'],['required'=>"请输入描述"]);

            $form->number('nums','库存')
                ->default(0);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }


    /**
     * 查询过滤
     * @return \Closure
     */
    public function filter()
    {
        return function ($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            $filter->like('name','名称');
        };
    }
}
