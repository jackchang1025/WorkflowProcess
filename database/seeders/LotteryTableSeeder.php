<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LotteryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lottery')->delete();
        
        \DB::table('lottery')->insert(array (
            0 => 
            array (
                'id' => 1,
                'lottery_group_id' => 1,
                'lottery_id' => 1231,
                'title' => '极速快三',
                'code' => 'jsks',
                'period' => 1440,
                'period_interval' => 114,
                'url' => 'https://wssa-341.dalianjrkj.com:1586/lottery-wapi/wapi',
                'length' => 3,
                'version' => '1.0',
                'status' => 1,
                'order' => 0,
                'start_time' => '15:18:13',
                'end_time' => '15:18:15',
                'describe' => NULL,
                'created_at' => '2023-04-28 07:19:39',
                'updated_at' => '2023-05-15 16:12:32',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'lottery_group_id' => 3,
                'lottery_id' => 1,
                'title' => '射龙门',
                'code' => 'CBLM',
                'period' => 0,
                'period_interval' => 0,
                'url' => 'https://destinedworld9999.net',
                'length' => 3,
                'version' => '1.0',
                'status' => 1,
                'order' => 0,
                'start_time' => '13:12:23',
                'end_time' => '13:12:26',
                'describe' => NULL,
                'created_at' => '2023-05-14 13:12:27',
                'updated_at' => '2023-05-14 13:12:27',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}