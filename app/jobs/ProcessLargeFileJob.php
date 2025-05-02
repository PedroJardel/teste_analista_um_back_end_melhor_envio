<?php

namespace App\Jobs;

use App\Http\DTOs\NewConsumerDTO;
use App\Models\Consumer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessLargeFileJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public object $line)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $consumer = new NewConsumerDTO (
            $this->line->authenticated_entity->consumer_id->uuid
        );
        

    }
}
