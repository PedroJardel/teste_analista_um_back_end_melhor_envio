<?php
namespace App\Http\repositories;

use App\Http\repositories\interfaces\ExportRequestsByConsumerCsvRepository;
use App\Models\Consumer;
use App\Models\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ExportRequestsByConsumerCsvEloquentRepository implements ExportRequestsByConsumerCsvRepository
{
    public function requestsByConsumer(Consumer $consumer): Collection
    {
        return Request::whereConsumerId($consumer->id)
        ->get();
    }
}