<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_log', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('request_id')->comment('request_id');
            $table->string('issue')->default('')->comment('期号');
            $table->string('bet_code')->default('')->comment('投注号码');
            $table->float('bet_code_odds')->comment('投注号码赔率');
            $table->string('lottery_code')->default('')->comment('开奖号码');
            $table->integer('bet_amount')->comment('投注金额');
            $table->integer('bet_total_amount')->comment('投注总金额');
            $table->integer('win_lose')->comment('输赢');
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
        Schema::dropIfExists('request_log');
    }
}
