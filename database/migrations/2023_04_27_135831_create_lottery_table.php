<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottery', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('lottery_group_id')->comment('彩票组id');
            $table->integer('lottery_id')->comment('接口彩票id');
            $table->string('title')->comment('名称');
            $table->string('code')->unique()->comment('编码');
            $table->integer('period')->comment('期数');
            $table->integer('period_interval')->comment('期数间隔');
            $table->string('url')->comment('url');
            $table->integer('length')->comment('长度');
            $table->string('version')->comment('版本');
            $table->tinyInteger('status')->default(1)->comment('状态');
            $table->integer('order')->default(0)->comment('排序');
            $table->time('start_time')->comment('开始时间');
            $table->time('end_time')->comment('结束时间');
            $table->longText('describe')->nullable()->comment('描述');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lottery');
    }
};
