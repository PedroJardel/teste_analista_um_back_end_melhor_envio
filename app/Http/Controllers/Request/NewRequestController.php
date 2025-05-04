<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewRequestFormRequest;
use App\Http\Services\Request\NewRequestService;
use Exception;
use Illuminate\Support\Facades\Log;

class NewRequestController extends Controller
{
    public function __construct(private NewRequestService $newRequestService)
    {
    }

    public function __invoke(NewRequestFormRequest $request)
    {
        try {
            $request = $this->newRequestService->__invoke($request->validated());
            return response()->json($request, 200);
        } catch (Exception $exception) {
            Log::error('NewRequestController.invoke', [
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
