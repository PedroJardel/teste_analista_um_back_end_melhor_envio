<?php

namespace App\Http\DTOs;

class NewConsumerDTO
{
    public function __construct(
        public string $id,
    )
    {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,

        ];
    }
}