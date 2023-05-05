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
        Schema::table('request', function (Blueprint $table) {
            $table->string('current_bet_code_rule')->nullable()->comment('当前投注号码规则');
            $table->float('current_bet_amount_rule')->nullable()->comment('当前投注金额规则');
            $table->string('current_issue')->nullable()->comment('当前期号');
            $table->string('last_issue')->nullable()->comment('上一期号');
            $table->longText('win_lose_rules')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request', function (Blueprint $table) {
            $table->dropColumn('current_bet_code_rule');
            $table->dropColumn('current_bet_amount_rule');
            $table->dropColumn('current_issue');
            $table->dropColumn('last_issue');
            $table->string('win_lose_rules')->nullable()->change();

        });
    }
};
