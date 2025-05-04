<?php

namespace App\Providers;

use App\Http\repositories\AverageTimeLatenciesRequestEloquentRepository;
use App\Http\repositories\ConsumerEloquentRepository;
use App\Http\repositories\ExportRequestsByConsumerCsvEloquentRepository;
use App\Http\repositories\ExportRequestsByGatewayServiceCsvEloquentRepository;
use App\Http\repositories\GatewayServiceEloquentRepository;
use App\Http\repositories\interfaces\AverageTimeLatenciesRequestRepository;
use App\Http\repositories\interfaces\ConsumerRepository;
use App\Http\repositories\interfaces\ExportRequestsByConsumerCsvRepository;
use App\Http\repositories\interfaces\ExportRequestsByGatewayServiceCsvRepository;
use App\Http\repositories\interfaces\GatewayServiceRepository;
use App\Http\repositories\interfaces\RequestRepository;
use App\Http\repositories\RequestEloquentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ConsumerRepository::class => ConsumerEloquentRepository::class,
        GatewayServiceRepository::class => GatewayServiceEloquentRepository::class,
        RequestRepository::class => RequestEloquentRepository::class,
        ExportRequestsByConsumerCsvRepository::class => ExportRequestsByConsumerCsvEloquentRepository::class,
        ExportRequestsByGatewayServiceCsvRepository::class => ExportRequestsByGatewayServiceCsvEloquentRepository::class,
        AverageTimeLatenciesRequestRepository::class => AverageTimeLatenciesRequestEloquentRepository::class,
    ];
}
