<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AdminExtensionHistoriesTableSeeder::class);
        $this->call(AdminExtensionsTableSeeder::class);
        $this->call(AdminMenuTableSeeder::class);
        $this->call(AdminPermissionMenuTableSeeder::class);
        $this->call(AdminPermissionsTableSeeder::class);
        $this->call(AdminRoleMenuTableSeeder::class);
        $this->call(AdminRolePermissionsTableSeeder::class);
        $this->call(AdminRoleUsersTableSeeder::class);
        $this->call(AdminRolesTableSeeder::class);
        $this->call(AdminSettingsTableSeeder::class);
        $this->call(AdminUsersTableSeeder::class);
        $this->call(FailedJobsTableSeeder::class);
        $this->call(FrequencyParametersTableSeeder::class);
        $this->call(LotteryTableSeeder::class);
        $this->call(LotteryGroupTableSeeder::class);
        $this->call(LotteryOptionTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(PersonalAccessTokensTableSeeder::class);
        $this->call(ProcessesTableSeeder::class);
        $this->call(RequestTableSeeder::class);
        $this->call(RequestLogTableSeeder::class);
        $this->call(RequestLotteryOptionTableSeeder::class);
        $this->call(RuleTableSeeder::class);
        $this->call(TaskFrequenciesTableSeeder::class);
        $this->call(TaskResultsTableSeeder::class);
        $this->call(TasksTableSeeder::class);
        $this->call(TokenTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
