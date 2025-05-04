<?php

namespace App\Jobs;

use App\Http\DTOs\NewConsumerDTO;
use App\Http\DTOs\NewGatewayServiceDTO;
use App\Http\DTOs\NewRequestDTO;
use App\Http\repositories\interfaces\RequestRepository;
use Carbon\Carbon;
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
        $gatewayService = new NewGatewayServiceDTO(
            $this->line->service->id,
            $this->line->service->host,
            $this->line->service->port,
            $this->line->service->protocol,
            $this->line->service->name,
            Carbon::createFromTimestamp($this->line->service->created_at),
        );
        $request = new NewRequestDTO(
            $this->line->request->method,
            $this->line->request->url,
            $this->line->response->status,
            $consumer->id,
            $gatewayService->id,
            $this->line->route->id,
            $this->line->client_ip,
            $this->line->latencies->proxy,
            $this->line->latencies->gateway,
            $this->line->latencies->request,
        );
        $requestRepository = app(RequestRepository::class);
        $requestRepository->add($consumer, $gatewayService, $request);
    }
}
