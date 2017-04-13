<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMybimgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybimg', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userid');
            $table->string('auditid');
            $table->string('auditto')->defaule(0);
            $table->string('bimgx');
            $table->string('bimgb');
            $table->string('bimgt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mybimg');
    }
}
