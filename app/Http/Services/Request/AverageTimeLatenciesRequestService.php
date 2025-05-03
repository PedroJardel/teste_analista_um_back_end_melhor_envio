<?php
namespace App\Http\Services\Request;

use App\Http\repositories\interfaces\AverageTimeLatenciesRequestRepository;
use App\Models\GatewayService;
use League\Csv\Writer;
use SplTempFileObject;

class AverageTimeLatenciesRequestService
{
    public function __construct(private AverageTimeLatenciesRequestRepository $averageTimeLatenciesRequestRepository)
    {
    }

    public function averageTimeLatencies()
    {
        $requests = $this->averageTimeLatenciesRequestRepository->averageLatenciesRequest();
        $requestCsv = Writer::createFromFileObject(new SplTempFileObject());
        $requestCsv->setEscape('');
        $requestCsv->insertOne([ 
            'service_id',
            'average_latency_proxy',
            'average_latency_gateway',
            'average_latency_request'
        ]);

        $requestsArray = $requests->map(function ($request) {
            return [
                $request->service_id,
                round($request->avg_latency_proxy,6),
                round($request->avg_latency_gateway,6),
                round($request->avg_latency_request, 6),
            ];
        });
        $requestCsv->insertAll($requestsArray->all());
        return $requestCsv;
    }
}