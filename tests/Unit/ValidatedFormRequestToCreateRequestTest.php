<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValidatedFormRequestToCreateRequestTest extends TestCase
{
    use RefreshDatabase;
    private string $urlDocker = 'http://localhost:80/api/requests/create';
    private string $urlLocal = 'http://localhost:8000/api/requests/create';

    public function  test_semantic_errros_in_request_for_create_request(): void
    {
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
                    'uuid' => '7ba24e1f-ed19-31b2-a4be-4114721d63af'
                ]
            ],
            'service' => [
                'created_at' => 1549572086,
                'host' => 'orn.com',
                'id' => 'a5bf08bd-c030-30d5-8009-83a8c30103bf',
                'name' => 'orn',
                'protocol' => 'http',
            ],
            'latencies' => [
                'proxy' => 1644,
                'gateway' => 11,
                'request' => 1648,
            ],
        ];

        $response = $this->postJson($this->urlDocker, $data, [
            'Accept' => 'application/json'
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors'
            ]);
    }
}
