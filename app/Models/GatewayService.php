<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GatewayService extends Model
{
    protected $casts = [
        'created_at' => 'datetime'
    ];
    protected $fillable = [
        'id',
        'host',
        'port',
        'protocol',
        'name',
        'created_at'
    ];

           /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services';
}
