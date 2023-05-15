<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FrequencyParametersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('frequency_parameters')->delete();
        
        \DB::table('frequency_parameters')->insert(array (
            0 => 
            array (
                'id' => 1,
                'frequency_id' => 2,
                'name' => 'at',
                'value' => '23:00:00',
                'created_at' => '2023-05-06 10:40:36',
                'updated_at' => '2023-05-06 11:01:19',
            ),
            1 => 
            array (
                'id' => 2,
                'frequency_id' => 3,
                'name' => 'at',
                'value' => '12:10:00',
                'created_at' => '2023-05-13 12:01:06',
                'updated_at' => '2023-05-13 12:01:06',
            ),
        ));
        
        
    }
}