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
            //作品ID
            $table->increments('id');
            //用户ID
            $table->string('userid');
            //审核人ID
            $table->string('auditid');
            //审核状态
            $table->string('auditto')->defaule(0);
            //文本内容
            $table->string('bimgx');
            //文本标题
            $table->string('bimgb');
            //文本上传时间
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
