<?php
namespace App\Http\repositories;

use App\Http\DTOs\NewConsumerDTO;
use App\Http\repositories\interfaces\ConsumerRepository;
use App\Models\Consumer;
use Exception;

class ConsumerEloquentRepository implements ConsumerRepository
{
    public function add(NewConsumerDTO $consumer): Consumer
    {
        if(!$this->consumerExists($consumer)) {
            throw new Exception('This Consumer already exists', 422);
        }
        return Consumer::create($consumer->toArray());
    }

    public function consumerById(string $id): Consumer|null
    {
        return Consumer::find($id);
    }

    private function consumerExists(NewConsumerDTO $newConsumer): bool
    {
        $consumer = $this->consumerById($newConsumer->id);

        if($consumer !== null) {
            return false;
        }
        return true;
    }
}