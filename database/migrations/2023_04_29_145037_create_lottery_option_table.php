<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotteryOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottery_option', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('parent_id')->default('0')->comment('分类id');
            $table->string('title')->unique()->default('')->comment('名称');
            $table->integer('status')->default('1')->comment('状态');
            $table->integer('order')->default('0')->comment('排序');
            $table->string('rule')->nullable()->default('')->comment('规则');
            $table->float('odds')->nullable()->comment('赔率');
            $table->string('value')->nullable()->default('')->comment('值');
            $table->text('description')->nullable()->comment('描述');
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
        Schema::dropIfExists('lottery_option');
    }
}
