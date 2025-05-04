<?php

namespace App\Http\repositories;

use App\Http\DTOs\NewGatewayServiceDTO;
use App\Http\repositories\interfaces\GatewayServiceRepository;
use App\Models\GatewayService;
use DomainException;

class GatewayServiceEloquentRepository implements GatewayServiceRepository
{
    public function add(NewGatewayServiceDTO $newGatewayService): GatewayService
    {
        if(!$this->gatewayServiceNotExists($newGatewayService)) {
            throw new DomainException('This GatewayService already exists', 422);
        }
        return GatewayService::create($newGatewayService->toArray());
    }

    public function gatewayServiceById(string $id): GatewayService|null
    {
        return GatewayService::find($id);
    }

    public function gatewayServiceNotExists(NewGatewayServiceDTO $newGatewayService): bool
    {
        $gatewayService = $this->gatewayServiceById($newGatewayService->id);

        if($gatewayService !== null) {
            return false;
        }
        return true;
    }
}
