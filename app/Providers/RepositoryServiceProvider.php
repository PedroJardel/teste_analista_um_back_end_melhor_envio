<?php

namespace App\Providers;

use App\Http\repositories\ConsumerEloquentRepository;
use App\Http\repositories\interfaces\ConsumerRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ConsumerRepository::class => ConsumerEloquentRepository::class
    ];
}
