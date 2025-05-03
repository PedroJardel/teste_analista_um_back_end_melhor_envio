<?php
namespace App\Http\repositories;

use App\Http\DTOs\NewConsumerDTO;
use App\Http\DTOs\NewGatewayServiceDTO;
use App\Http\DTOs\NewRequestDTO;
use App\Http\repositories\interfaces\ConsumerRepository;
use App\Http\repositories\interfaces\GatewayServiceRepository;
use App\Http\repositories\interfaces\ImportRequestFileRepository;
use App\Models\Consumer;
use App\Models\GatewayService;
use App\Models\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportRequestFileEloquentRepository implements ImportRequestFileRepository
{
    public function __construct(private ConsumerRepository $consumerRepository, private GatewayServiceRepository $gatewayServiceRepository){}
    public function add(NewConsumerDTO $newConsumer, NewGatewayServiceDTO $newGatewayService, NewRequestDTO $newRequest)
    {
        try {
        return DB::transaction( function () use ($newConsumer, $newGatewayService, $newRequest):Request {
            if($this->consumerRepository->consumerNotExists($newConsumer)) {
                Consumer::create($newConsumer->toArray());
            }
            if($this->gatewayServiceRepository->gatewayServiceNotExists($newGatewayService)) {
                GatewayService::create($newGatewayService->toArray());
            }
            return Request::create($newRequest->toArray());
        }, 2);
        } catch (Exception $exception) {
            Log::error('ImportRequestFileEloquentRepository.add', [
                'message' => $exception->getMessage(),
                'line' => $exception->getLine(),
                'file' => $exception->getFile(),
            ]);
        }
    }

    public function requestById(string $id): Request|null
    {
        return Request::find($id);
    }
}