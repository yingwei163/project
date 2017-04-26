<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publish', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('bimg_id');//作品id集
            $table->string('names');  //作品name集
            $table->string('icons');  //图片地址集合
            $table->string('user_id');//用户id
            $table->string('title');  //连载标题
            $table->string('cover');  //连载封面
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publish');
    }
}
