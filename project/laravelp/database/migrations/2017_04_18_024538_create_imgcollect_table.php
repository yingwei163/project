<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImgcollectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //【暴图】作品的(收藏，评论，点赞，差评的统计)数据表
        Schema::create('imgcollect', function (Blueprint $table) {
            $table->increments('id');   //主键
            $table->timestamps();
            $table->integer('works_id');    //作品的id
            $table->integer('collects');         //收藏的数量
            $table->integer('talks');            //评论的数量
            $table->integer('praises');          //点赞的数量
            $table->integer('rottens');          //差评的数量

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
