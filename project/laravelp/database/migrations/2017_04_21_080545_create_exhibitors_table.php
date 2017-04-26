<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('Exhibitors', function (Blueprint $table) {
                $table->increments('id');
                $table->string('eid');  //订阅id
                $table->string('eimg');
                $table->string('etime');
                $table->string('tit');  //订阅标题
                $table->string('txt');  //正文
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exhibitors');
    }
}
