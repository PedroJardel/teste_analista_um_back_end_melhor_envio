<?php

namespace App\Providers;

use App\Http\repositories\ConsumerEloquentRepository;
use App\Http\repositories\ExportRequestsByConsumerCsvEloquentRepository;
use App\Http\repositories\ExportRequestsByGatewayServiceCsvEloquentRepository;
use App\Http\repositories\GatewayServiceEloquentRepository;
use App\Http\repositories\ImportRequestFileEloquentRepository;
use App\Http\repositories\interfaces\ConsumerRepository;
use App\Http\repositories\interfaces\ExportRequestsByConsumerCsvRepository;
use App\Http\repositories\interfaces\ExportRequestsByGatewayServiceCsvRepository;
use App\Http\repositories\interfaces\GatewayServiceRepository;
use App\Http\repositories\interfaces\ImportRequestFileRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ConsumerRepository::class => ConsumerEloquentRepository::class,
        GatewayServiceRepository::class => GatewayServiceEloquentRepository::class,
        ImportRequestFileRepository::class => ImportRequestFileEloquentRepository::class,
        ExportRequestsByConsumerCsvRepository::class => ExportRequestsByConsumerCsvEloquentRepository::class,
        ExportRequestsByGatewayServiceCsvRepository::class => ExportRequestsByGatewayServiceCsvEloquentRepository::class
    ];
}
