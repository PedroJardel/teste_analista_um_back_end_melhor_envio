<?php
namespace App\Http\Services;

use App\Jobs\ProcessFileLineJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class ReceiveRequestsLogService
{
    const CHUNK_SIZE = 500;
    public function readFile(string $path)
    {
        $request = fopen(storage_path("app/private/{$path}"), 'r');
        $jobs = [];

        while (($line = fgets($request)) !== false) {
            $jobs[] = new ProcessFileLineJob($line);
            Log::info("job", [
                "line" => $line
            ]);

            if (count($jobs) >= self::CHUNK_SIZE) {
                Bus::batch($jobs)->dispatch();
                $jobs = [];
            }
        }
    
        if (!empty($jobs)) {
            Log::info("leu cedo");
            Bus::batch($jobs)->dispatch();
        }
    
        fclose($request);
    }
}