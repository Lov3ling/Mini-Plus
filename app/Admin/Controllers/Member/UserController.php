<?php

namespace App\Admin\Controllers\Member;

use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserController extends Controller
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
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('name','用户名');
            $grid->column('avatar','头像')->image('',32,32);
            $grid->column('nickname','昵称');
            $grid->column('email','邮箱');
            $grid->column('money','余额');
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
        return Admin::form(User::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name','用户名');
            $form->image('avatar','头像');
            $form->text('nickname','昵称');
            $form->password('password','密码');
            $form->email('email','邮箱');
            $form->mobile('mobile','手机');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
            $form->saved($this->saved());

        });
    }


    /**
     * saved callback
     *
     * @return \Closure
     */
    public function saved()
    {
        return function (Form $form){
            $form->model()->password=bcrypt($form->model()->password);
            $form->model()->save();
        };
    }

}
