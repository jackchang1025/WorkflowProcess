<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_users')->delete();
        
        \DB::table('admin_users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'admin',
                'password' => '$2y$10$DDf7brq5eRn2q1jn71bJ6.q/UPNeiqJXbflH/0zn..LQdEAtIkGZ2',
                'name' => 'Administrator',
                'avatar' => NULL,
                'remember_token' => 'bmIpUZudY4xwT0HwUqYetnTimBoSd0xuZyB1VxASPoEQ4n22uevXnAQhD8Lt',
                'created_at' => '2023-04-27 10:00:11',
                'updated_at' => '2023-04-27 10:00:12',
            ),
        ));
        
        
    }
}