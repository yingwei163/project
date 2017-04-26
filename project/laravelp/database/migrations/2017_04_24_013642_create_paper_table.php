<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paper', function (Blueprint $table) {
            //小纸条ID
            $table->increments('id');
            //发送用户ID
            $table->string('userid');
            //文本内容
            $table->string('paperx');
            //文本标题
            $table->string('paperb');
            //文本上传时间
            $table->string('papert');
            //发布用户名
            $table->string('name');
            //发布用户头像
            $table->string('userimg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paper');
    }
}
