<?php
namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use App\Http\Services\Request\ExportRequestsByGatewaySericeCsvService;
use App\Models\GatewayService;
use Exception;
use Illuminate\Support\Facades\Log;

class ExportRequestsByGatewayServiceCsvController extends Controller
{
    public function __construct(private ExportRequestsByGatewaySericeCsvService $exportRequestsByGatewayServiceCsvService)
    {
    }

    public function __invoke(GatewayService $gatewayService)
    {
        try {
            $requestCsv = $this->exportRequestsByGatewayServiceCsvService->exportCsv($gatewayService);
            return response()->streamDownload(function () use ($requestCsv){
                echo $requestCsv->toString();
            }, 'service_requests_report.csv', [
                'Content-Type' => 'text/csv',
            ]);
        } catch (Exception $exception) {
            Log::error('ExportRequestsByGatewayServiceCsvController.invoke', [
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
