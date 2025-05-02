<?php
namespace App\Http\Services;

use App\Jobs\ProcessLargeFileJob;

class ReceiveRequestsLogService
{
    public function readFile(string $path)
    {
        $request = fopen(storage_path("app/private/{$path}"), 'r');
        while (($line = fgets($request)) !== false) {
            ProcessLargeFileJob::dispatch(json_decode(trim($line)));
        }
        fclose($request);
    }
}