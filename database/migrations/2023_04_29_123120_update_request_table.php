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
        Schema::table('request',function (Blueprint $table)
        {
            $table->bigInteger('token_id')->nullable()->comment('token id')->after('lottery_id');
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
            $table->dropColumn('token_id');
        });
    }
};
