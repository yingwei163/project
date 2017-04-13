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
            $table->increments('id');
            $table->string('userid');
            $table->string('auditid');
            $table->string('auditto')->defaule(0);
            $table->string('videox');
            $table->string('videob');
            $table->string('videot');
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
