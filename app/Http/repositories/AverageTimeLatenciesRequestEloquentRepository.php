<?php

namespace App\Http\repositories;

use App\Http\repositories\interfaces\AverageTimeLatenciesRequestRepository;
use App\Models\Request as RequestModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AverageTimeLatenciesRequestEloquentRepository implements AverageTimeLatenciesRequestRepository
{
    public function averageLatenciesRequest(): Collection
    {
        $requests = RequestModel::query()
            ->select(
                'service_id',
                DB::raw('AVG(latency_proxy) as avg_latency_proxy'),
                DB::raw('AVG(latency_gateway) as avg_latency_gateway'),
                DB::raw('AVG(latency_request) as avg_latency_request'),
            )
            ->groupBy('service_id')
            ->get();
        return $requests;
    }
}
