<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'method',
        'status_code',
        'consumer_id',
        'service_id',
        'route_id',
        'client_ip',
        'latency_proxy',
        'latency_gateway',
        'latency_request',
    ];

        /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
