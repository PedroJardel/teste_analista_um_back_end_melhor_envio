<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceiveLogRequest;
use App\Http\Services\ReceiveRequestsLogService;
use Exception;
use Illuminate\Support\Facades\Log;

class ReceiveRequestsLogController extends Controller
{
    public function __construct(private ReceiveRequestsLogService $receiveRequestsLogService) 
    {

    }
    public function __invoke(ReceiveLogRequest $request)
    {
        try {
            $fileMimeType = $request->validated('file')->getClientMimeType();
            if( $fileMimeType !== 'text/plain') {
                throw new Exception('mimteType is not text/plain', 422);
            }

            $path = $request->validated('file')->store('logs', 'local');
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
