<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tasks')->delete();
        
        \DB::table('tasks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => '创建请求',
                'command' => 'request:crontab',
                'parameters' => '14',
                'expression' => NULL,
                'timezone' => 'Asia/Shanghai',
                'is_active' => 1,
                'dont_overlap' => 0,
                'run_in_maintenance' => 0,
                'notification_email_address' => NULL,
                'notification_phone_number' => NULL,
                'notification_slack_webhook' => NULL,
                'created_at' => '2023-05-06 09:59:05',
                'updated_at' => '2023-05-12 11:06:47',
                'auto_cleanup_num' => 0,
                'auto_cleanup_type' => 'days',
                'run_on_one_server' => 0,
                'run_in_background' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => '创建请求',
                'command' => 'request:crontab',
                'parameters' => '14',
                'expression' => NULL,
                'timezone' => 'Asia/Shanghai',
                'is_active' => 1,
                'dont_overlap' => 0,
                'run_in_maintenance' => 0,
                'notification_email_address' => NULL,
                'notification_phone_number' => NULL,
                'notification_slack_webhook' => NULL,
                'created_at' => '2023-05-13 12:01:06',
                'updated_at' => '2023-05-13 12:01:06',
                'auto_cleanup_num' => 0,
                'auto_cleanup_type' => 'days',
                'run_on_one_server' => 0,
                'run_in_background' => 0,
            ),
        ));
        
        
    }
}