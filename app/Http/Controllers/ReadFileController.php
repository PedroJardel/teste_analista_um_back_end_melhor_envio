<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessFileJob;
use Exception;
use Illuminate\Support\Facades\Log;

class ReadFileController extends Controller
{
    public function __construct() {}
    public function __invoke()
    {
        try {
            ProcessFileJob::dispatch("logs/logs.txt");

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
                ],
                $exception->getCode()
            );
        }
    }
}
