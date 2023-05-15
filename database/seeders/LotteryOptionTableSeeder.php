<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LotteryOptionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lottery_option')->delete();
        
        \DB::table('lottery_option')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'title' => '总和',
                'status' => 1,
                'order' => 0,
                'rule' => 'required|string|explode:.|array_sum',
                'odds' => 0.0,
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2023-04-29 14:59:32',
                'updated_at' => '2023-04-29 15:35:16',
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 1,
                'title' => '大',
                'status' => 1,
                'order' => 0,
                'rule' => 'required|string|explode:.|array_sum|numeric|between:11,18',
                'odds' => 1.95,
                'value' => '大',
                'description' => NULL,
                'created_at' => '2023-04-29 15:35:50',
                'updated_at' => '2023-04-30 07:28:59',
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 1,
                'title' => '小',
                'status' => 1,
                'order' => 0,
                'rule' => 'required|string|explode:.|array_sum|numeric|between:3,10',
                'odds' => 1.95,
                'value' => '小',
                'description' => NULL,
                'created_at' => '2023-04-29 15:36:20',
                'updated_at' => '2023-04-30 07:29:07',
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 1,
                'title' => '单',
                'status' => 1,
                'order' => 0,
                'rule' => 'required|string|explode:.|array_sum|numeric|in:3,5,7,9,11,13,15,17',
                'odds' => 1.95,
                'value' => '单',
                'description' => NULL,
                'created_at' => '2023-04-29 15:37:10',
                'updated_at' => '2023-04-30 07:29:14',
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 1,
                'title' => '双',
                'status' => 1,
                'order' => 0,
                'rule' => 'required|string|explode:.|array_sum|numeric|in:4,6,8,10,12,14,16,18',
                'odds' => 1.95,
                'value' => '双',
                'description' => NULL,
                'created_at' => '2023-04-29 15:37:34',
                'updated_at' => '2023-04-30 07:29:21',
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 0,
                'title' => '射龙门',
                'status' => 1,
                'order' => 0,
                'rule' => NULL,
                'odds' => 0.0,
                'value' => NULL,
                'description' => NULL,
                'created_at' => '2023-05-14 16:42:56',
                'updated_at' => '2023-05-14 16:42:56',
            ),
            6 => 
            array (
                'id' => 7,
                'parent_id' => 6,
                'title' => '庄',
                'status' => 1,
                'order' => 0,
                'rule' => 'determineResultVillage',
                'odds' => 3.5300000000000002,
                'value' => '庄',
                'description' => NULL,
                'created_at' => '2023-05-14 17:03:55',
                'updated_at' => '2023-05-14 17:55:44',
            ),
            7 => 
            array (
                'id' => 8,
                'parent_id' => 6,
                'title' => '闲',
                'status' => 1,
                'order' => 0,
                'rule' => 'determineResultIdle',
                'odds' => 1.6,
                'value' => '闲',
                'description' => NULL,
                'created_at' => '2023-05-14 17:04:36',
                'updated_at' => '2023-05-14 17:55:59',
            ),
            8 => 
            array (
                'id' => 9,
                'parent_id' => 6,
                'title' => '和',
                'status' => 1,
                'order' => 0,
                'rule' => 'determineResultAnd',
                'odds' => 8.49,
                'value' => '和',
                'description' => NULL,
                'created_at' => '2023-05-14 17:05:11',
                'updated_at' => '2023-05-14 17:56:11',
            ),
        ));
        
        
    }
}