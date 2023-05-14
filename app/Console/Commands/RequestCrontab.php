<?php

namespace App\Console\Commands;

use App\Jobs\RequestJob;
use App\Models\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class RequestCrontab extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'request:crontab {id*}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Request Crontab';

    /**
     * Execute the console command.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        $id = $this->argument('id');

        $id = array_unique($id);

        foreach ($id as $value) {

            try {

                $request = Request::findOrFail($value);

                $newRequest = $request->replicate();

                $newRequest->status = Request::STATUS_PENDING;
                $newRequest->lottery_rules = null;
                $newRequest->lottery_count_rules = 0;
                $newRequest->bet_amount_rules = 0;
                $newRequest->bet_total_amount_rules = $newRequest->total_amount_rules;
                $newRequest->bet_code_rules = null;
                $newRequest->bet_count_rules = 0;
                $newRequest->win_lose_rules = 1;
                $newRequest->continuous_lose_count_rules = 0;
                $newRequest->continuous_win_count_rules = 0;
                $newRequest->continuous_bet_count = 0;
                $newRequest->current_bet_code_rule = null;
                $newRequest->current_bet_amount_rule = 0;
                $newRequest->current_issue = '';
                $newRequest->save();

                RequestJob::dispatch($newRequest->id);

                Log::info('Request Crontab ' . $newRequest->id . ' ' . Carbon::now());
                $this->info('Request Crontab ' . $newRequest->id . ' ' . Carbon::now());

            } catch (\Exception $e) {

                Log::info('Request Crontab ' . $e->getMessage());
                $this->error('Request Crontab ' .$e->getMessage());

                throw $e;
            }
        }
    }
}
