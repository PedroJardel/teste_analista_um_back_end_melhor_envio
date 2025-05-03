<?php
namespace App\Http\repositories;

use App\Http\repositories\interfaces\ExportRequestsByGatewayServiceCsvRepository;
use App\Models\Consumer;
use App\Models\GatewayService;
use App\Models\Request;
use Illuminate\Database\Eloquent\Collection;

class ExportRequestsByGatewayServiceCsvEloquentRepository implements ExportRequestsByGatewayServiceCsvRepository
{
    public function requestsByGatewayService(GatewayService $service): Collection
    {   
        return Request::whereServiceId($service->id)
        ->get();
    }
}