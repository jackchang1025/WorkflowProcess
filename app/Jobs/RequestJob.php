<?php

namespace App\Jobs;

use App\Models\Request;
use App\Services\ProcessService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 任务运行的超时时间。
     *
     * @var int
     */
    public int $timeout = 0;

    /**
     * 任务可尝试次数
     *
     * @var int
     */
    public int $tries = 0;

    /**
     * 任务失败前允许的最大异常数
     *
     * @var int
     */
    public int $maxExceptions = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected readonly string $id)
    {
        $this->onQueue('request');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ProcessService $processService)
    {
        $request = Request::findOrFail($this->id);

        return $processService->handle($request);
    }
}
