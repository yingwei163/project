<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gid');  //作品id
            $table->string('uid');  //用户id
            $table->string('good'); //好评
            $table->string('bad'); //差评
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zan');
    }
}
