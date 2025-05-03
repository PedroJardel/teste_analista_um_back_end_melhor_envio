<?php
namespace App\Http\repositories\interfaces;

use App\Http\DTOs\NewGatewayServiceDTO;
use App\Models\GatewayService;

interface GatewayServiceRepository 
{
    public function add(NewGatewayServiceDTO $newGatewayService): GatewayService;
    public function gatewayServiceById(string $id): GatewayService|null;
    public function gatewayServiceNotExists(NewGatewayServiceDTO $newGatewayService): bool;
}