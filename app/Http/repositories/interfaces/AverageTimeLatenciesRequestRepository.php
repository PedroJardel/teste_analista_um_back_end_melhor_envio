<?php
namespace App\Http\repositories\interfaces;

use Illuminate\Database\Eloquent\Collection;

interface AverageTimeLatenciesRequestRepository
{
    public function averageLatenciesRequest(): Collection;
}
