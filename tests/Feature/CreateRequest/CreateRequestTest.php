<?php

namespace Tests\Feature\CreateRequest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CreateRequestTest extends TestCase
{
    use RefreshDatabase;
    private string $url = 'http://localhost:8000/api/requests/create';

    public function test_create_request_success(): void
    {
        $miliseconds = (int) round(microtime(true) * 1000);
        $data = [
            'request' => [
                'method' => 'GET',
                'url' => 'http://wolf.com'
            ],
            'response' => [
                'status' => 500,
            ],
            'authenticated_entity' => [
                'consumer_id' => [
                    'uuid' => Uuid::uuid4()->toString()
                ]
            ],
            'route' => [
                'id' => Uuid::uuid4()->toString()
            ],
            'service' => [
                'created_at' => $miliseconds,
                'host' => 'orn.com',
                'port' => 80,
                'id' => Uuid::uuid4()->toString(),
                'name' => 'orn',
                'protocol' => 'http',
            ],
            'latencies' => [
                'proxy' => 1644,
                'gateway' => 11,
                'request' => 1648,
            ],
            'client_ip' => '227.161.59.27',
        ];
        $response = $this->post($this->url, $data, [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(200);
    }
}
