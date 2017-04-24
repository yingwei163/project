<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeuserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('y_user', function (Blueprint $table) {
            //用户登陆ID
            $table->increments('id');
            //用户名
            $table->string('name');
            //用户邮箱
            $table->string('email');
            //用户密码
            $table->string('password');
            //用户注销token
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homeuser');
    }
}
