<?php
namespace App\Http\Services\Request;

use App\Http\repositories\interfaces\ExportRequestsByConsumerCsvRepository;
use App\Http\repositories\interfaces\ExportRequestsByGatewayServiceCsvRepository;
use App\Models\Consumer;
use App\Models\GatewayService;
use League\Csv\Writer;
use SplTempFileObject;

class ExportRequestsByGatewaySericeCsvService
{
    public function __construct(private ExportRequestsByGatewayServiceCsvRepository $exportRequestsByGatewayServiceCsvRepository)
    {
    }

    public function exportCsv(GatewayService $gatewayService): Writer 
    {
        $requests = $this->exportRequestsByGatewayServiceCsvRepository->requestsByGatewayService($gatewayService);
        $requestCsv = Writer::createFromFileObject(new SplTempFileObject());
        $requestCsv->setEscape('');
        $requestCsv->insertOne([
            'method', 
            'url', 
            'status_code', 
            'consumer_id', 
            'service_id',
            'route_id', 
            'client_ip',
            'latency_proxy',
            'latency_gateway',
            'latency_request'
        ]);

        $requestsArray = $requests->map(function ($request) {
            return [
                $request->method,
                $request->url,
                $request->status_code,
                $request->consumer_id,
                $request->service_id,
                $request->route_id,
                $request->client_ip,
                $request->latency_proxy,
                $request->latency_gateway,
                $request->latency_request,
            ];
        });
        $requestCsv->insertAll($requestsArray->all());
        return $requestCsv;
    }
}