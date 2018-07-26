<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');     //文件名
            $table->string('path');     //路径
            $table->integer('size');    //大小
            $table->string('ext');      //类型
            $table->string('mime');     //文件mime类型
            $table->string('url')->nullale();   //访问路径
            $table->text('sha1');       //sha1散列
            $table->string('md5');      //文件MD5
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('files');
    }
}
