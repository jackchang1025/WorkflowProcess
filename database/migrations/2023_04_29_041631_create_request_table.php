<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('bpmn_xml')->comment('bpmn_xml');
            $table->bigInteger('lottery_option_id')->comment('lottery_option_id');
            $table->bigInteger('lottery_id')->comment('lottery_id');
            $table->integer('code_type')->comment('类型');
            $table->integer('status')->default('1')->comment('状态');
            $table->string('lottery_rules')->nullable()->comment('开奖规则');
            $table->integer('lottery_count_rules')->default('0')->nullable()->comment('开奖总次数规则');
            $table->integer('bet_base_amount_rules')->default('0')->nullable()->comment('基础投注金额规则');
            $table->integer('bet_total_amount_rules')->default('0')->nullable()->comment('总投注金额规则');
            $table->string('bet_amount_rules')->nullable()->comment('投注金额规则');
            $table->string('bet_code_rules')->nullable()->comment('投注号码规则');
            $table->integer('bet_count_rules')->default('0')->nullable()->comment('投注次数规则');
            $table->string('win_lose_rules')->nullable()->comment('输赢规则');
            $table->integer('continuous_lose_count_rules')->default('0')->nullable()->comment('连续输次数规则');
            $table->integer('continuous_win_count_rules')->default('0')->nullable()->comment('连续赢次数规则');
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
        Schema::dropIfExists('request');
    }
}
