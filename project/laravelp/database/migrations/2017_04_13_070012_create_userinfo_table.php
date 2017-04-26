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
            //信息ID
            $table->increments('id');
            //注册时间
            $table->timestamps();
            //用户ID
            $table->string('uid');
            //用户手机
            $table->string('phone');
            //用户头像
            $table->string('icon')->defaule('/images/default.png');
            //用户生日
            $table->string('bir');
            //用户地址
            $table->string('addr');
            //用户性别
            $table->integer('sex')->defaule(0);
            //关注
            $table->integer('foll')->defaule(0);
            //粉丝
            $table->integer('fan')->defaule(0);
            //神作
            $table->integer('clan')->defaule(0);
            //尼玛币
            $table->integer('cash')->defaule(0);
            //总评论
            $table->integer('comm')->defaule(0);
            //总顶数
            $table->integer('total')->defaule(0);
            //参与值
            $table->integer('join')->defaule(0);
            //创意值
            $table->integer('idea')->defaule(0);
            //邮箱验证码
            $table->string('confirmed_code');
            //邮箱是否验证
            $table->integer('is_confirmed');
            //手机验证码
            $table->string('phonecode');
            //手机是否验证
            $table->string('is_phone');
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
