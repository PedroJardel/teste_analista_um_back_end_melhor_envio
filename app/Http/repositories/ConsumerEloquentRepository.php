<?php
namespace App\Http\repositories;

use App\Http\DTOs\NewConsumerDTO;
use App\Http\repositories\interfaces\ConsumerRepository;
use App\Models\Consumer;

class ConsumerEloquentRepository implements ConsumerRepository
{
    public function add (NewConsumerDTO $consumer): Consumer
    {
        return Consumer::create($consumer->toArray());
    }
}