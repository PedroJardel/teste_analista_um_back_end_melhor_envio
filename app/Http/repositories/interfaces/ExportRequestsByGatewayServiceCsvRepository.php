<?php
namespace App\Http\repositories\interfaces;

use App\Models\Consumer;
use App\Models\GatewayService;

interface ExportRequestsByGatewayServiceCsvRepository
{
    public function requestsByGatewayService(GatewayService $gatewayService);
}