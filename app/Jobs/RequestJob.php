<?php

namespace App\Jobs;

use App\Models\Request;
use App\Services\ProcessService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RequestJob implements ShouldQueue, ShouldBeUnique
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
    public  $tries = null;

    /**
     * 任务失败前允许的最大异常数
     *
     * @var int
     */
    public  $maxExceptions = null;

    /**
     * 作业的唯一锁将被释放的秒数。
     *
     * @var int
     */
    public int $uniqueFor = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected readonly int $id)
    {

    }


    public function uniqueId(): int
    {
        return $this->id;
    }


    /**
     * Execute the job.
     *
     * @param ProcessService $processService
     * @return void
     * @throws \Exception
     */
    public function handle(ProcessService $processService)
    {
        echo "{$this->id} RequestJob start" . PHP_EOL;

        $request = Request::findOrFail($this->id);

        try {

            $processService->handle($request);

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            Request::where('id', $this->id)->update(['status' => Request::STATUS_FAILED]);

            echo "{$e->getMessage()}" . PHP_EOL;
        }

        echo "{$this->id} RequestJob end" . PHP_EOL;
    }
}
