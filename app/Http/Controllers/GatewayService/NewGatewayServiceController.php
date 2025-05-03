<?php

namespace App\Http\Controllers\GatewayService;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewGatewayServiceRequest;
use App\Http\Services\GatewayService\NewGatewayService;
use Exception;
use Illuminate\Support\Facades\Log;

class NewGatewayServiceController extends Controller
{
    public function __construct(private NewGatewayService $newGatewayService){}

    public function __invoke(NewGatewayServiceRequest $request)
    {
        try {
            $gatewayService = $this->newGatewayService->__invoke($request->validated());
            return response()->json($gatewayService, 200);
        } catch (Exception $exception) {
            Log::error('NewGatewayServiceController.invoke', [
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
