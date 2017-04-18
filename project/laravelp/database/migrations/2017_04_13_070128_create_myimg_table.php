<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyimgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myimg', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userid');
            $table->string('auditid');
            $table->string('auditto')->defaule(0);
            $table->string('imgx');
            $table->string('imgb');
            $table->string('imgt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('myimg');
    }
}
