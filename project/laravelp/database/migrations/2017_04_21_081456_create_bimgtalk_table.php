<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBimgtalkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bimgtalk', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('user_id');       //评论的用户id
            $table->string('work_id');       //评论的作品
            $table->string('talk_txt');      //评论的内容
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bimgtalk');
    }
}
