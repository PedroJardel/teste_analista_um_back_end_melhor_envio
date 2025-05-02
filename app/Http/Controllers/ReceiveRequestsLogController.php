<?php

namespace App\Http\Controllers;

use App\Http\Services\ReceiveRequestsLogService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReceiveRequestsLogController extends Controller
{
    public function __construct(private ReceiveRequestsLogService $receiveRequestsLogService) 
    {

    }
    public function __invoke(Request $request)
    {
        try {
            if (!$request->file('log')) {
                throw new Exception("Logs file not found", 404);
            }
            
            $path = $request->file('log')->store('logs', 'local');
            $this->receiveRequestsLogService->readFile($path);

            return response()->json(['message' => 'Processing...'], 200);
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
