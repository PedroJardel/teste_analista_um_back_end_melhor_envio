<?php

namespace App\Http\repositories;

use App\Http\DTOs\NewConsumerDTO;
use App\Http\repositories\interfaces\ConsumerRepository;
use App\Models\Consumer;
use DomainException;

class ConsumerEloquentRepository implements ConsumerRepository
{
    public function add(NewConsumerDTO $consumer): Consumer
    {
        if (!$this->consumerNotExists($consumer)) {
            throw new DomainException('This Consumer already exists', 422);
        }
        return Consumer::create($consumer->toArray());
    }

    public function consumerById(string $id): Consumer|null
    {
            $consumer = Consumer::find($id);
            return $consumer;
    }

    public function consumerNotExists(NewConsumerDTO $newConsumer): bool
    {
        $consumer = $this->consumerById($newConsumer->id);

        if (!empty($consumer)) {
            return false;
        }
        return true;
    }
}