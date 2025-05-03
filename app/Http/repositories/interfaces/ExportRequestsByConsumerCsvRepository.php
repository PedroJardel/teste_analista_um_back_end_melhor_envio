<?php
namespace App\Http\repositories\interfaces;

use App\Models\Consumer;

interface ExportRequestsByConsumerCsvRepository
{
    public function requestsByConsumer(Consumer $consumer);
}