<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RuleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rule')->delete();
        
        \DB::table('rule')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => '3A',
                'status' => 1,
                'type' => NULL,
            'rule' => '/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}/u',
                'description' => NULL,
                'created_at' => '2023-05-04 15:08:29',
                'updated_at' => '2023-05-04 16:11:24',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => '4A',
                'status' => 1,
                'type' => NULL,
            'rule' => '/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{3,}/u',
                'description' => NULL,
                'created_at' => '2023-05-04 15:09:14',
                'updated_at' => '2023-05-04 16:30:31',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => '5A',
                'status' => 1,
                'type' => NULL,
            'rule' => '/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{4,}/u',
                'description' => NULL,
                'created_at' => '2023-05-04 15:09:36',
                'updated_at' => '2023-05-04 16:30:43',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => '6A',
                'status' => 1,
                'type' => NULL,
            'rule' => '/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{5,}/u',
                'description' => NULL,
                'created_at' => '2023-05-04 15:09:56',
                'updated_at' => '2023-05-04 16:30:56',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => '7A',
                'status' => 1,
                'type' => NULL,
            'rule' => '/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{6,}/u',
                'description' => NULL,
                'created_at' => '2023-05-04 15:10:09',
                'updated_at' => '2023-05-04 16:31:06',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => '8A',
                'status' => 1,
                'type' => NULL,
            'rule' => '/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{7,}/u',
                'description' => NULL,
                'created_at' => '2023-05-04 15:10:23',
                'updated_at' => '2023-05-04 16:31:16',
            ),
            6 => 
            array (
                'id' => 7,
                'title' => '9A',
                'status' => 1,
                'type' => NULL,
            'rule' => '/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{8,}/u',
                'description' => NULL,
                'created_at' => '2023-05-04 15:10:33',
                'updated_at' => '2023-05-04 16:31:30',
            ),
            7 => 
            array (
                'id' => 8,
                'title' => '10A',
                'status' => 1,
                'type' => NULL,
            'rule' => '/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{9,}/u',
                'description' => NULL,
                'created_at' => '2023-05-04 15:10:46',
                'updated_at' => '2023-05-04 16:31:37',
            ),
            8 => 
            array (
                'id' => 9,
                'title' => 'ABAB',
                'status' => 1,
                'type' => NULL,
            'rule' => '/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])(?!\\1)([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1\\2/u',
                'description' => NULL,
                'created_at' => '2023-05-05 09:35:15',
                'updated_at' => '2023-05-05 09:35:15',
            ),
            9 => 
            array (
                'id' => 10,
                'title' => 'ABABAB',
                'status' => 1,
                'type' => NULL,
            'rule' => '/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])(?!\\1)([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1\\2\\1\\2/u',
                'description' => NULL,
                'created_at' => '2023-05-05 09:35:44',
                'updated_at' => '2023-05-05 09:35:44',
            ),
            10 => 
            array (
                'id' => 11,
                'title' => 'ABABABAB',
                'status' => 1,
                'type' => NULL,
            'rule' => '/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])(?!\\1)([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1\\2\\1\\2\\1\\2/u',
                'description' => NULL,
                'created_at' => '2023-05-05 09:36:06',
                'updated_at' => '2023-05-05 09:36:06',
            ),
            11 => 
            array (
                'id' => 12,
                'title' => '2A',
                'status' => 1,
                'type' => NULL,
            'rule' => '/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{1,}/u',
                'description' => NULL,
                'created_at' => '2023-05-12 09:36:04',
                'updated_at' => '2023-05-12 09:36:38',
            ),
        ));
        
        
    }
}