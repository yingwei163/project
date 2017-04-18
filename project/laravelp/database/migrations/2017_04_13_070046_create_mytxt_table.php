<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMytxtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mytxt', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userid');
            $table->string('auditid');
            $table->string('auditto')->defaule(0);
            $table->string('txtx');
            $table->string('txtb');
            $table->string('txtt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mytxt');
    }
}
