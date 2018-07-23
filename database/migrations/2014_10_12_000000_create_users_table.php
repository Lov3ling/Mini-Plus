<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('用户名');
            $table->string('email')->unique()->comment('邮箱');
            $table->string('password')->comment('密码');
            $table->string('mobile')->nullable()->comment('联系电话');
            $table->integer('type')->default(0)->comment('用户类型');
            $table->string('nickname')->comment('昵称');
            $table->string('avatar')->comment('头像');
            $table->boolean('is_active')->default(0)->comment('是否激活');
            $table->decimal('money')->default(0)->comment('余额');
            $table->timestamp('login_time')->nullable()->comment('最后登录时间');
            $table->ipAddress('login_ip')->nullable()->comment('最后登录IP');
            $table->boolean('status')->default(1)->comment('是否启用');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
