<?php

namespace App\Jobs;

use App\Http\DTOs\NewConsumerDTO;
use App\Http\DTOs\NewGatewayServiceDTO;
use App\Http\DTOs\NewRequestDTO;
use App\Http\repositories\interfaces\RequestRepository;
use Carbon\Carbon;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessFileLineJob implements ShouldQueue
{
    use Queueable, Batchable;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $line)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $line = json_decode(trim($this->line));
        $consumer = new NewConsumerDTO (
            $line->authenticated_entity->consumer_id->uuid
        );
        $gatewayService = new NewGatewayServiceDTO(
            $line->service->id,
            $line->service->host,
            $line->service->port,
            $line->service->protocol,
            $line->service->name,
            Carbon::createFromTimestamp($line->service->created_at),
        );
        $request = new NewRequestDTO(
            $line->request->method,
            $line->request->url,
            $line->response->status,
            $consumer->id,
            $gatewayService->id,
            $line->route->id,
            $line->client_ip,
            $line->latencies->proxy,
            $line->latencies->gateway,
            $line->latencies->request,
        );
        $requestRepository = app(RequestRepository::class);
        $requestRepository->add($consumer, $gatewayService, $request);
    }
}
