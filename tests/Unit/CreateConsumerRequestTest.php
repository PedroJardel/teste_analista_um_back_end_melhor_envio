<?php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateConsumerRequestTest extends TestCase
{
    use RefreshDatabase;
    private string $urlDocker = 'http://localhost:80/api/consumer';
    private string $urlLocal = 'http://localhost:8000/api/consumer';

    public function  test_semantic_errros_in_request_for_create_consumer(): void
    {
        $data = [
            'consumer_id' => [
                'uuid' => '7ba24e1f-ed19-31b2-a4be-4114721d63af'
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