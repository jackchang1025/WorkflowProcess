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
        Schema::table('request_log', function (Blueprint $table) {
            $table->string('bet_code')->nullable()->change();
            $table->string('bet_code_odds')->nullable()->change();
            $table->string('lottery_code')->nullable()->change();
            $table->string('bet_amount')->nullable()->change();
            $table->string('bet_total_amount')->nullable()->change();
            $table->string('win_lose')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_log', function (Blueprint $table) {
            $table->string('bet_code')->change();
            $table->string('bet_code_odds')->change();
            $table->string('lottery_code')->change();
            $table->string('bet_amount')->change();
            $table->string('bet_total_amount')->change();
            $table->string('win_lose')->change();
        });
    }
};
