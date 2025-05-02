<?php

namespace App\Http\Controllers\Consumer;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewConsumerRequest;
use App\Http\Services\Consumer\NewConsumerService;
use Exception;
use Illuminate\Support\Facades\Log;

class NewConsumerController extends Controller
{
    public function __construct(private NewConsumerService $newConsumerService) {}

    public function __invoke(NewConsumerRequest $request)
    {
        try {
            $consumer = $this->newConsumerService->__invoke($request);
            return response()->json($consumer, 200);
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
