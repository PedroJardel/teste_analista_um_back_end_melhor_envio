<?php

namespace Tests\Feature\CreateGatewayService;

use App\Http\DTOs\NewGatewayServiceDTO;
use App\Http\repositories\interfaces\GatewayServiceRepository;
use Carbon\Carbon;
use DomainException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CreateGatewayServiceTest extends TestCase
{
    use RefreshDatabase;
    
    private string $url = 'http://localhost:80/api/gatewayService';

    public function test_expected_exception_for_gatewayService_already_exists_endpoint(): void
    {
        $data = [
            'service' => [
                'created_at' => 1549572086,
                'host' => 'orn.com',
                'id' => 'a5bf08bd-c030-30d5-8009-83a8c30103bf',
                'name' => 'orn',
                'port' => 80,
                'protocol' => 'http',
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
                'message' => 'This GatewayService already exists'
            ]);
    }

    public function test_expected_exception_for_gatewayService_already_exists_repository(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('This GatewayService already exists');
        $this->expectExceptionCode(422);

        $newGatewayService = new NewGatewayServiceDTO(
            'a5bf08bd-c030-30d5-8009-83a8c30103bf',
            'orn.com',
            80,
            'http',
            'orn',
            Carbon::createFromTimestamp(1549572086)
        );
        $gatewayServiceRepository = app(GatewayServiceRepository::class);

        $gatewayServiceRepository->add($newGatewayService);
        $gatewayServiceRepository->add($newGatewayService);
    }

    public function test_create_gatewayService_success(): void
    {
        $miliseconds = (int) round(microtime(true) * 1000);
        $data = [
            'service' => [
                'created_at' => $miliseconds,
                'host' => 'orn.com',
                'id' => Uuid::uuid4()->toString(),
                'name' => 'orn',
                'port' => 80,
                'protocol' => 'http',
            ]
        ];
            $response = $this->post($this->url, $data, [
                'Accept' => 'application/json'
            ]);
            $response->assertStatus(200);
    }
}