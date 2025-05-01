<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GatewayService extends Model
{
    protected $fillable = [
        'host',
        'port',
        'protocol',
        'name',
        'created_at'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services';
}
