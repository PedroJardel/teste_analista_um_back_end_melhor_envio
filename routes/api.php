<?php

use App\Http\Controllers\Consumer\NewConsumerController;
use App\Http\Controllers\GatewayService\NewGatewayServiceController;
use App\Http\Controllers\ReceiveRequestsLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/requests/import', ReceiveRequestsLogController::class);
Route::post('/consumer', NewConsumerController::class);
Route::post('/gatewayService', NewGatewayServiceController::class);
Route::get('/requests/export/consumer/{consumer}', NewGatewayServiceController::class);
Route::get('/requests/export/gatewayService/{gatewayService}', NewGatewayServiceController::class);
