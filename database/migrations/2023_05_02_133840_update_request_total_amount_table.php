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
            $table->longText('bet_amount_rules')->nullable()->comment('投注金额规则')->change();
            $table->longText('bet_code_rules')->nullable()->comment('投注号码规则')->change();
            $table->float('total_amount_rules')->comment('投注总金额');
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
            $table->string('bet_amount_rules')->nullable()->comment('投注金额规则')->change();
            $table->string('bet_code_rules')->nullable()->comment('投注号码规则')->change();
            $table->dropColumn('total_amount_rules');
        });
    }
};
