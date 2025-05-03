<?php

namespace App\Http\repositories;

use App\Http\DTOs\NewGatewayServiceDTO;
use App\Http\repositories\interfaces\GatewayServiceRepository;
use App\Models\GatewayService;
use Exception;

class GatewayServiceEloquentRepository implements GatewayServiceRepository
{
    public function add(NewGatewayServiceDTO $newGatewayService): GatewayService
    {
        if(!$this->gatewayServiceExists($newGatewayService)) {
            throw new Exception('This GatewayService already exists', 422);
        }
        return GatewayService::create($newGatewayService->toArray());
    }

    public function gatewayServiceById(string $id): GatewayService|null
    {
        return GatewayService::find($id);
    }

    private function gatewayServiceExists(NewGatewayServiceDTO $newGatewayService): bool
    {
        $gatewayService = $this->gatewayServiceById($newGatewayService->id);

        if($gatewayService !== null) {
            return false;
        }
        return true;
    }
}
