<?php
namespace App\Http\repositories;

use App\Http\repositories\interfaces\ExportRequestsByGatewayServiceCsvRepository;
use App\Models\Consumer;
use App\Models\GatewayService;
use App\Models\Request;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class ExportRequestsByGatewayServiceCsvEloquentRepository implements ExportRequestsByGatewayServiceCsvRepository
{
    public function requestsByGatewayService(GatewayService $service): Collection
    {   
        $requestsCollection = new Collection();
        try {
            Request::select()
            ->whereServiceId($service->id)
            ->chunk(5000, function ($chunked) use (&$requestsCollection) {
                $requestsCollection = $requestsCollection->merge($chunked);
            });
        } catch (Exception $exception) {
            Log::error('ReceiveRequestLogController.invoke', [
                'message' => $exception->getMessage(),
                'line' => $exception->getLine(),
                'file' => $exception->getFile(),
            ]);
        }
        return $requestsCollection;
    }
}