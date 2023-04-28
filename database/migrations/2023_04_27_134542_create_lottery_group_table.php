<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotteryGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottery_group', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique()->default('')->comment('名称');
            $table->integer('parent_id')->default('0')->comment('父类id');
            $table->integer('order')->default('0')->comment('排序');
            $table->integer('status')->default('1')->comment('状态');
            $table->string('driver_type')->default('')->comment('类型');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lottery_group');
    }
}
