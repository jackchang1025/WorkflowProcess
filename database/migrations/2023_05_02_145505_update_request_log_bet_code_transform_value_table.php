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
            $table->string('bet_code_transform_value')->nullable()->comment('投注号码转换值')->after('bet_code');

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
            $table->dropColumn('bet_code_transform_value');

        });
    }
};
