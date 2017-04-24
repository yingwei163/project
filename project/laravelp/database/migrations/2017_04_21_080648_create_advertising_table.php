<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertising', function (Blueprint $table) {
            $table->increments('id');
            $table->string('img');
            $table->string('nama'); //广告名
            $table->string('body');  //剪短的介绍自己
            $table->string('ad');   //重点介绍自己
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertising');
    }
}
