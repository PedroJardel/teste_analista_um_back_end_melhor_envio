<?php

namespace App\Http\Services\Consumer;

use App\Http\DTOs\NewConsumerDTO;
use App\Http\repositories\interfaces\ConsumerRepository;

class NewConsumerService
{
    public function __construct(private ConsumerRepository $consumerRepository)
    {

    }

    public function __invoke(array $data)
    {
        $consumer = new NewConsumerDTO($data["authenticated_entity"]["consumer_id"]["uuid"]);
        return $this->consumerRepository->add($consumer);
    }
}