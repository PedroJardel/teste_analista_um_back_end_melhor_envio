<?php
namespace App\Http\DTOs;

class NewRequestDTO
{
    public function __construct(
        public string $method,
        public string $url,
        public int $status_code,
        public string $consumer_id,
        public string $service_id,
        public string $route_id,
        public string $client_ip,
        public int $latency_proxy,
        public int $latency_gateway,
        public int $latency_request,
    )
    {}

    public function toArray(): array
    {
        return [
            'method' => $this->method,
            'url' => $this->url,
            'status_code' => $this->status_code,
            'consumer_id' => $this->consumer_id,
            'service_id' => $this->service_id,
            'route_id' => $this->route_id,
            'client_ip' => $this->client_ip,
            'latency_proxy' => $this->latency_proxy,
            'latency_gateway' => $this->latency_gateway,
            'latency_request' => $this->latency_request,
        ];
    }
}