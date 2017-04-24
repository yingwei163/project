<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invideo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('videoid');
            $table->string('videob');
            $table->string('name');
            $table->string('images');
            $table->integer('tovideo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invideo');
    }
}
