<?php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateGateWayServiceRequestTest extends TestCase
{
    use RefreshDatabase;
    private string $urlDocker = 'http://localhost:80/api/gatewayService';
    private string $urlLocal = 'http://localhost:8000/api/gatewayService';

    public function test_semantic_errros_in_request_for_create_gatewayService(): void
    {
        $data = [
            'service' => [
                'created_at' => 1549572086,
                'host' => 'orn.com',
                'id' => 'a5bf08bd-c030-30d5-8009-83a8c30103bf',
                'name' => 'orn',
                'protocol' => 'http',
            ]
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