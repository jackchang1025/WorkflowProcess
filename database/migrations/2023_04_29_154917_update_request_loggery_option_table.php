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
        Schema::table('request',function (Blueprint $table){
            $table->dropColumn('lottery_option_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request',function (Blueprint $table)
        {
            $table->bigInteger('lottery_option_id')->comment('lottery_option_id')->after('bpmn_xml');
        });
    }
};
