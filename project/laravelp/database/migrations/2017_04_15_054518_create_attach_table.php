<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attach', function (Blueprint $table) {
            //权限ID
            $table->increments('id');
            //权限名
            $table->string('name');
            //权限路由
            $table->string('route');
            //权限路由描述
            $table->string('routetake');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attach');
    }
}
