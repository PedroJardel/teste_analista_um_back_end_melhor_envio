<?php

namespace App\Jobs;

use App\Http\Services\ReceiveRequestsLogService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessFileJob implements ShouldQueue
{
    use Queueable;

    public $timeout = 300;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $path)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            app(ReceiveRequestsLogService::class)->readFile($this->path);
        } catch (Exception $exception) {
            Log::error("Jobs.ProcessFileJob", [
                "message" => $exception->getMessage(),
                "file" => $exception->getFile(),
                "line" => $exception->getLine()
            ]);
        }
    }
}
