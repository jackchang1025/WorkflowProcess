<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaskFrequenciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('task_frequencies')->delete();
        
        \DB::table('task_frequencies')->insert(array (
            0 => 
            array (
                'id' => 2,
                'task_id' => 1,
                'label' => 'Daily at',
                'interval' => 'dailyAt',
                'created_at' => '2023-05-06 10:40:36',
                'updated_at' => '2023-05-06 10:40:36',
            ),
            1 => 
            array (
                'id' => 3,
                'task_id' => 2,
                'label' => 'Daily at',
                'interval' => 'dailyAt',
                'created_at' => '2023-05-13 12:01:06',
                'updated_at' => '2023-05-13 12:01:06',
            ),
        ));
        
        
    }
}