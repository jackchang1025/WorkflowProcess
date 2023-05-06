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

        foreach ($id as $value) {

            try {

                $request = Request::findOrFail($value);

                $newRequest = $request->replicate();

                $newRequest->title  = $newRequest->title . ' ' . Carbon::now();
                $newRequest->status = Request::STATUS_PENDING;
                $newRequest->save();

                RequestJob::dispatch($newRequest->id);

                Log::info('Request Crontab ' . $newRequest->id . ' ' . Carbon::now());
                $this->info('Request Crontab ' . $newRequest->id . ' ' . Carbon::now());

            } catch (\Exception $e) {

                $this->error('Request Crontab ' . $value . ' not found');

                throw $e;

            }
        }
    }
}
