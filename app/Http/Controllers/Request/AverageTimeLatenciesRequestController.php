<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use App\Http\Services\Request\AverageTimeLatenciesRequestService;
use App\Models\GatewayService;
use Exception;
use Illuminate\Support\Facades\Log;

class AverageTimeLatenciesRequestController extends Controller
{
    public function __construct(private AverageTimeLatenciesRequestService $averageTimeLatenciesRequestService)
    {
    }

    public function __invoke()
    {
        try{
            $averageLatenciesTimeCsv = $this->averageTimeLatenciesRequestService->averageTimeLatencies();
            return response()->streamDownload(function () use ($averageLatenciesTimeCsv){
                echo $averageLatenciesTimeCsv->toString();
            }, 'consumer_requests_report.csv', [
                'Content-Type' => 'text/csv',
            ]);
        } catch (Exception $exception) {
            Log::error('AverageTimeLatenciesRequestController.invoke', [
                'message' => $exception->getMessage(),
                'line' => $exception->getLine(),
                'file' => $exception->getFile(),
            ]);
            return response(
                [
                    'message' => $exception->getMessage()
                ], $exception->getCode());
        }
    }
}
