<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //【暴图】作品评价数据库
        Schema::create('message', function (Blueprint $table) {
            $table->increments('id'); //主键
            $table->timestamps();
            $table->integer('works_id');    //作品拥有者的id
            $table->integer('message_id');  //评价者的id
            $table->integer('collect')->defaule(0);      //收藏(0->未收藏 1-收藏)
            $table->integer('talk')->defaule(0);         //评论(0->未评论 1-评论)
            $table->integer('praise')->defaule(0);       //赞(0->未赞 1-赞)
            $table->integer('rotten')->defaule(0);       //烂(0->未烂 1-烂)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message');
    }
}
