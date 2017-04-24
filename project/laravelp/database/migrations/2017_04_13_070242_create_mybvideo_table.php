<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMybvideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('myvideo', function (Blueprint $table) {
            //作品ID
            $table->increments('id');
            //用户ID
            $table->string('userid');
            //文本内容
            $table->string('videox');
            //文本标题
            $table->string('videob');
            //文本上传时间
            $table->string('videot');
            //发布用户名
            $table->string('name');
            //发布视频代表图
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('myvideo');
    }
}
