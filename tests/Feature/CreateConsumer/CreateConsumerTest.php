<?php

namespace Tests\Feature\CreateConsumer;

use App\Http\DTOs\NewConsumerDTO;
use App\Http\repositories\interfaces\ConsumerRepository;
use DomainException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CreateConsumerTest extends TestCase
{
    use RefreshDatabase;
    private string $url = 'http://localhost:80/api/consumer';

    public function test_expected_exception_for_consumer_already_exists_endpoint(): void
    {
        $data = [
            'authenticated_entity' => [
                'consumer_id' => [
                    'uuid' => '7ba24e1f-ed19-31b2-a4be-4114721d63af'
                ]
            ]
        ];

        $this->postJson($this->url, $data, [
            'Accept' => 'application/json'
        ]);

        $response = $this->postJson($this->url, $data, [
            'Accept' => 'application/json'
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonFragment([
                'message' => 'This Consumer already exists'
            ]);
    }

    public function test_expected_exception_for_consumer_already_exists_repository(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('This Consumer already exists');
        $this->expectExceptionCode(422);

        $newConsumer = new NewConsumerDTO(
            '7ba24e1f-ed19-31b2-a4be-4114721d63af'
        );
        $consumerRepository = app(ConsumerRepository::class);

        $consumerRepository->add($newConsumer);
        $consumerRepository->add($newConsumer);
    }

    public function test_create_consumer_success(): void
    {
        $data = [
            'authenticated_entity' => [
                'consumer_id' => [
                    'uuid' => Uuid::uuid4()->toString()
                ]
            ]
        ];
        $response = $this->post($this->url, $data, [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(200);
    }
}
