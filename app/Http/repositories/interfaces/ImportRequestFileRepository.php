<?php

namespace App\Http\repositories\interfaces;

use App\Http\DTOs\NewConsumerDTO;
use App\Http\DTOs\NewGatewayServiceDTO;
use App\Http\DTOs\NewRequestDTO;
use App\Models\Request;

interface ImportRequestFileRepository
{
    public function add(NewConsumerDTO $newConsumer, NewGatewayServiceDTO $newGatewayService, NewRequestDTO $newRequest);
    public function requestById(string $id): Request|null;
}
