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
        Schema::create('request_lottery_option', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('request_id')->comment('请求id');
            $table->bigInteger('lottery_option_id')->comment('彩票选项id');
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
        Schema::dropIfExists('request_lottery_option');
    }
};
