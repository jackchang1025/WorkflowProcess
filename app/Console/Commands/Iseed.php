<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Iseed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iseed:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成数据库所有种子文件';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tables = DB::select('show tables');

        $tableString = '';
        foreach ($tables as $table){
            foreach ($table as $item){
                $tableString .= "{$item},";
            }
        }

        if ($tableString = trim($tableString,',')){
            $this->call('iseed', [
                'tables' => $tableString, '--force'=>true
            ]);
        }
    }
}
