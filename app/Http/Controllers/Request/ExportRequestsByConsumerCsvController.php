<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use App\Http\Services\Request\ExportRequestsByConsumerCsvService;
use App\Models\Consumer;
use Exception;
use Illuminate\Support\Facades\Log;

class ExportRequestsByConsumerCsvController extends Controller
{
    public function __construct(private ExportRequestsByConsumerCsvService $exportRequestsByConsumerCsvService)
    {
    }

    public function __invoke(Consumer $consumer)
    {
        try {
            $requestCsv = $this->exportRequestsByConsumerCsvService->exportCsv($consumer);
            return response()->streamDownload(function () use ($requestCsv){
                echo $requestCsv->toString();
            }, 'consumer_requests_report.csv', [
                'Content-Type' => 'text/csv',
            ]);
        } catch (Exception $exception) {
            Log::error('ReceiveRequestLogController.invoke', [
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
