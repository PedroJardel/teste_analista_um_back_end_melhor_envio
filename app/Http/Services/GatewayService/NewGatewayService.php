<?php

namespace App\Http\Services\GatewayService;

use App\Http\DTOs\NewGatewayServiceDTO;
use App\Http\repositories\interfaces\GatewayServiceRepository;
use App\Models\GatewayService;
use Carbon\Carbon;

class NewGatewayService
{
    public function __construct(private GatewayServiceRepository $gatewayServiceRepository){}

    public function __invoke(array $data): GatewayService
    {

        $newGatewayService = new NewGatewayServiceDTO (
            $data['service']['id'],
            $data['service']['host'],
            $data['service']['port'],
            $data['service']['protocol'],
            $data['service']['name'],
            Carbon::createFromTimestamp($data['service']['created_at']),
        );
        return $this->gatewayServiceRepository->add($newGatewayService);
    }
}
