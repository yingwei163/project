<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('uid');
            $table->string('phone');
            $table->string('icon')->defaule('/images/default');
            $table->string('bir');
            $table->string('addr');
            $table->integer('sex')->defaule(0);
            $table->integer('foll')->defaule(0);
            $table->integer('fan')->defaule(0);
            $table->integer('clan')->defaule(0);
            $table->integer('cash')->defaule(0);
            $table->integer('comm')->defaule(0);
            $table->integer('total')->defaule(0);
            $table->integer('join')->defaule(0);
            $table->integer('idea')->defaule(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userinfo');
    }
}
