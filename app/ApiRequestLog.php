<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiRequestLog extends Model
{
    /**
    * No updated_at is needed
    * created_at set default by db
    */
    public $timestamps = false;
    protected $fillable = [
        'url', 'method', 'status', 'body','executionTime'
    ];
}
