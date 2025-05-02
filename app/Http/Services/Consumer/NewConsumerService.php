<?php

namespace App\Http\Services\Consumer;

use App\Http\DTOs\NewConsumerDTO;
use App\Http\repositories\interfaces\ConsumerRepository;
use App\Http\Requests\NewConsumerRequest;

class NewConsumerService
{
    public function __construct(private ConsumerRepository $consumerRepository)
    {

    }

    public function __invoke(NewConsumerRequest $request)
    {
        $consumer = new NewConsumerDTO($request["authenticated_entity"]["consumer_id"]["uuid"]);
        return $this->consumerRepository->add($consumer);
    }
}
