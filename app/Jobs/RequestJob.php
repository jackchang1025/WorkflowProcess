<?php

namespace App\Jobs;

use App\Models\Process;
use App\Models\Request;
use App\Services\ProcessService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected readonly string $id)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ProcessService $processService)
    {
        return $processService->handle(Request::findOrFail($this->id));
    }
}
