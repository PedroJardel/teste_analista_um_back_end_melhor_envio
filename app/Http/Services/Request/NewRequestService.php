<?php
namespace App\Http\Services\Request;

use App\Http\DTOs\NewConsumerDTO;
use App\Http\DTOs\NewGatewayServiceDTO;
use App\Http\DTOs\NewRequestDTO;
use App\Http\repositories\interfaces\RequestRepository;
use App\Models\Request;
use Carbon\Carbon;

class NewRequestService
{
    public function __construct(private RequestRepository $requestRepository)
    {
    }

    public function __invoke(array $data): Request
    {
        $consumer = new NewConsumerDTO(
            $data["authenticated_entity"]["consumer_id"]["uuid"]
        );

        $gatewayService = new NewGatewayServiceDTO (
            $data['service']['id'],
            $data['service']['host'],
            $data['service']['port'],
            $data['service']['protocol'],
            $data['service']['name'],
            Carbon::createFromTimestamp($data['service']['created_at']),
        );

        $request = new NewRequestDTO (
            $data['request']['method'],
            $data['request']['url'],
            $data['response']['status'],
            $consumer->id,
            $gatewayService->id,
            $data['route']['id'],
            $data['client_ip'],
            $data['latencies']['proxy'],
            $data['latencies']['gateway'],
            $data['latencies']['request'],
        );

        return $this->requestRepository->add($consumer, $gatewayService, $request);
    }
}