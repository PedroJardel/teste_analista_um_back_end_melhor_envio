<?php

namespace App\Http\repositories;

use App\Http\DTOs\NewGatewayServiceDTO;
use App\Http\repositories\interfaces\GatewayServiceRepository;
use App\Models\GatewayService;
use Exception;
use Illuminate\Database\QueryException;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;

class GatewayServiceEloquentRepository implements GatewayServiceRepository
{
    public function add(NewGatewayServiceDTO $newGatewayService): GatewayService
    {
        if(!$this->gatewayServiceExists($newGatewayService)) {
            throw new Exception('GatewayService já cadastrado');
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
