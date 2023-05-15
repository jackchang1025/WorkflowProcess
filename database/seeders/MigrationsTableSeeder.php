<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'migration' => '2014_10_12_000000_create_users_table',
                'batch' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'migration' => '2014_10_12_100000_create_password_resets_table',
                'batch' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'migration' => '2016_01_04_173148_create_admin_tables',
                'batch' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'migration' => '2019_08_19_000000_create_failed_jobs_table',
                'batch' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'migration' => '2019_12_14_000001_create_personal_access_tokens_table',
                'batch' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'migration' => '2020_09_07_090635_create_admin_settings_table',
                'batch' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'migration' => '2020_09_22_015815_create_admin_extensions_table',
                'batch' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'migration' => '2020_11_01_083237_update_admin_menu_table',
                'batch' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'migration' => '2023_04_27_134542_create_lottery_group_table',
                'batch' => 2,
            ),
            9 => 
            array (
                'id' => 14,
                'migration' => '2023_04_27_135831_create_lottery_table',
                'batch' => 3,
            ),
            10 => 
            array (
                'id' => 15,
                'migration' => '2023_04_27_140858_create_processes_table',
                'batch' => 3,
            ),
            11 => 
            array (
                'id' => 16,
                'migration' => '2023_04_29_041631_create_request_table',
                'batch' => 4,
            ),
            12 => 
            array (
                'id' => 17,
                'migration' => '2023_04_29_042153_create_request_log_table',
                'batch' => 4,
            ),
            13 => 
            array (
                'id' => 21,
                'migration' => '2023_04_29_123120_update_request_table',
                'batch' => 5,
            ),
            14 => 
            array (
                'id' => 22,
                'migration' => '2023_04_29_124259_create_token_table',
                'batch' => 6,
            ),
            15 => 
            array (
                'id' => 24,
                'migration' => '2023_04_29_145037_create_lottery_option_table',
                'batch' => 7,
            ),
            16 => 
            array (
                'id' => 25,
                'migration' => '2023_04_29_154425_create_request_lottery_option_table',
                'batch' => 8,
            ),
            17 => 
            array (
                'id' => 26,
                'migration' => '2023_04_29_154917_update_request_loggery_option_table',
                'batch' => 9,
            ),
            18 => 
            array (
                'id' => 27,
                'migration' => '2023_04_30_073939_update_request_lottery_rules_table',
                'batch' => 10,
            ),
            19 => 
            array (
                'id' => 28,
                'migration' => '2023_04_30_080146_update_request_log_tabel',
                'batch' => 11,
            ),
            20 => 
            array (
                'id' => 29,
                'migration' => '2023_05_01_163201_updata_request_status_table',
                'batch' => 12,
            ),
            21 => 
            array (
                'id' => 30,
                'migration' => '2023_05_02_133840_update_request_total_amount_table',
                'batch' => 13,
            ),
            22 => 
            array (
                'id' => 31,
                'migration' => '2023_05_02_145505_update_request_log_bet_code_transform_value_table',
                'batch' => 14,
            ),
            23 => 
            array (
                'id' => 32,
                'migration' => '2023_05_04_144652_update_request_table',
                'batch' => 15,
            ),
            24 => 
            array (
                'id' => 33,
                'migration' => '2023_05_04_150007_create_rule_table',
                'batch' => 16,
            ),
            25 => 
            array (
                'id' => 34,
                'migration' => '2023_05_05_171037_update_request_table',
                'batch' => 17,
            ),
            26 => 
            array (
                'id' => 35,
                'migration' => '2017_08_05_194349_create_tasks_table',
                'batch' => 18,
            ),
            27 => 
            array (
                'id' => 36,
                'migration' => '2017_08_05_195539_create_task_frequencies_table',
                'batch' => 18,
            ),
            28 => 
            array (
                'id' => 37,
                'migration' => '2017_08_05_201914_create_task_results_table',
                'batch' => 18,
            ),
            29 => 
            array (
                'id' => 38,
                'migration' => '2017_08_24_085132_create_frequency_parameters_table',
                'batch' => 18,
            ),
            30 => 
            array (
                'id' => 39,
                'migration' => '2017_08_26_083622_alter_tasks_table_add_notifications_fields',
                'batch' => 18,
            ),
            31 => 
            array (
                'id' => 40,
                'migration' => '2018_01_02_121533_alter_tasks_table_add_auto_cleanup_num_and_type_fields',
                'batch' => 18,
            ),
            32 => 
            array (
                'id' => 41,
                'migration' => '2018_07_03_120000_alter_tasks_table_add_run_on_one_server_support',
                'batch' => 18,
            ),
            33 => 
            array (
                'id' => 42,
                'migration' => '2018_07_06_165603_add_indexes_for_tasks',
                'batch' => 18,
            ),
            34 => 
            array (
                'id' => 43,
                'migration' => '2019_09_25_103421_update_task_results_duration_type',
                'batch' => 18,
            ),
            35 => 
            array (
                'id' => 44,
                'migration' => '2020_12_10_120000_alter_tasks_table_add_run_in_background_support',
                'batch' => 18,
            ),
            36 => 
            array (
                'id' => 45,
                'migration' => '2022_03_14_120000_alter_task_results_table_add_index_on_created_at',
                'batch' => 18,
            ),
            37 => 
            array (
                'id' => 46,
                'migration' => '2023_05_07_174559_uddate_reuqest_continuous_bet_count_table',
                'batch' => 19,
            ),
            38 => 
            array (
                'id' => 47,
                'migration' => '2023_05_10_101851_uddate_reuqest_stop_betting_amount_table',
                'batch' => 20,
            ),
        ));
        
        
    }
}