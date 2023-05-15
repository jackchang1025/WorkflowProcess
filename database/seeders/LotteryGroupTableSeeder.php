<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LotteryGroupTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lottery_group')->delete();
        
        \DB::table('lottery_group')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => '快三',
                'parent_id' => 0,
                'order' => 0,
                'status' => 1,
                'driver_type' => 'extremelyFastThree',
                'created_at' => '2023-04-28 06:09:05',
                'updated_at' => '2023-04-28 07:09:44',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'vr',
                'parent_id' => 0,
                'order' => 0,
                'status' => 1,
                'driver_type' => 'extremelyFastThree',
                'created_at' => '2023-04-28 07:10:22',
                'updated_at' => '2023-04-28 07:10:22',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'BBIN',
                'parent_id' => 0,
                'order' => 0,
                'status' => 1,
                'driver_type' => 'web_socket_client',
                'created_at' => '2023-05-14 13:11:06',
                'updated_at' => '2023-05-14 13:11:06',
            ),
        ));
        
        
    }
}