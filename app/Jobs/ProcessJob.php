<?php

namespace App\Jobs;

use App\Models\Process;
use App\Services\ProcessService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessJob implements ShouldQueue
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
        $process = Process::findOrFail($this->id);

        return $processService->handle($process->bpmn_xml);
    }
}
