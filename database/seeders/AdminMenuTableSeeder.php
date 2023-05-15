<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_menu')->delete();
        
        \DB::table('admin_menu')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Index',
                'icon' => 'feather icon-bar-chart-2',
                'uri' => '/',
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-27 10:00:11',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 0,
                'order' => 2,
                'title' => 'Admin',
                'icon' => 'feather icon-settings',
                'uri' => '',
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-27 10:00:11',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 2,
                'order' => 3,
                'title' => 'Users',
                'icon' => '',
                'uri' => 'auth/users',
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-27 10:00:11',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 2,
                'order' => 4,
                'title' => 'Roles',
                'icon' => '',
                'uri' => 'auth/roles',
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-27 10:00:11',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 2,
                'order' => 5,
                'title' => 'Permission',
                'icon' => '',
                'uri' => 'auth/permissions',
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-27 10:00:11',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 2,
                'order' => 6,
                'title' => 'Menu',
                'icon' => '',
                'uri' => 'auth/menu',
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-27 10:00:11',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'parent_id' => 2,
                'order' => 7,
                'title' => 'Extensions',
                'icon' => '',
                'uri' => 'auth/extensions',
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-27 10:00:11',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'parent_id' => 0,
                'order' => 11,
                'title' => 'Processes',
                'icon' => 'fa-file-word-o',
                'uri' => NULL,
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-27 10:14:47',
                'updated_at' => '2023-04-27 14:09:55',
            ),
            8 => 
            array (
                'id' => 9,
                'parent_id' => 8,
                'order' => 12,
                'title' => 'Process',
                'icon' => NULL,
                'uri' => 'process',
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-27 10:16:06',
                'updated_at' => '2023-04-29 04:55:03',
            ),
            9 => 
            array (
                'id' => 10,
                'parent_id' => 0,
                'order' => 8,
                'title' => 'Lotterys',
                'icon' => 'fa-500px',
                'uri' => NULL,
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-27 13:37:36',
                'updated_at' => '2023-04-27 13:39:05',
            ),
            10 => 
            array (
                'id' => 11,
                'parent_id' => 10,
                'order' => 9,
                'title' => 'LotteryGroup',
                'icon' => NULL,
                'uri' => 'lottery_group',
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-27 13:38:28',
                'updated_at' => '2023-04-27 13:39:05',
            ),
            11 => 
            array (
                'id' => 12,
                'parent_id' => 10,
                'order' => 10,
                'title' => 'lottery',
                'icon' => NULL,
                'uri' => 'lottery',
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-27 13:38:45',
                'updated_at' => '2023-04-27 13:39:05',
            ),
            12 => 
            array (
                'id' => 13,
                'parent_id' => 8,
                'order' => 13,
                'title' => 'Request',
                'icon' => NULL,
                'uri' => 'request',
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-29 04:54:03',
                'updated_at' => '2023-04-29 04:54:03',
            ),
            13 => 
            array (
                'id' => 14,
                'parent_id' => 8,
                'order' => 14,
                'title' => 'RequestLog',
                'icon' => NULL,
                'uri' => 'request_log',
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-29 04:54:41',
                'updated_at' => '2023-04-29 04:54:41',
            ),
            14 => 
            array (
                'id' => 15,
                'parent_id' => 10,
                'order' => 15,
                'title' => 'Token',
                'icon' => NULL,
                'uri' => 'token',
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-29 12:46:24',
                'updated_at' => '2023-04-29 12:46:24',
            ),
            15 => 
            array (
                'id' => 16,
                'parent_id' => 10,
                'order' => 16,
                'title' => 'LotteryOption',
                'icon' => NULL,
                'uri' => 'lottery_option',
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-29 14:55:12',
                'updated_at' => '2023-04-29 14:55:12',
            ),
            16 => 
            array (
                'id' => 17,
                'parent_id' => 0,
                'order' => 17,
                'title' => 'Rules',
                'icon' => 'fa-drupal',
                'uri' => NULL,
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-05-04 15:05:26',
                'updated_at' => '2023-05-04 15:05:26',
            ),
            17 => 
            array (
                'id' => 18,
                'parent_id' => 17,
                'order' => 18,
                'title' => 'Rule',
                'icon' => NULL,
                'uri' => 'rule',
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-05-04 15:05:42',
                'updated_at' => '2023-05-04 15:05:42',
            ),
        ));
        
        
    }
}