<?php

namespace App\Http\DTOs;

use DateTime;

class NewGatewayServiceDTO
{
    public function __construct(
        public string $id,
        public string $host,
        public int $port,
        public string $protocol,
        public string $name,
        public DateTime $created_at
    )
    {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'host' => $this->host,
            'port' => $this->port,
            'protocol' => $this->protocol,
            'name' => $this->name,
            'created_at' => $this->created_at,
        ];
    }
}