<?php
namespace App\Http\repositories\interfaces;


use App\Http\DTOs\NewConsumerDTO;
use App\Models\Consumer;

interface ConsumerRepository 
{
    public function add(NewConsumerDTO $consumer): Consumer;
}