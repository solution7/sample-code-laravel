<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxSchemeAssociation extends Model
{
    use SoftDeletes;

    protected $guarded=[];
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at'];

    public function taxKey()
    {
        return $this->belongsTo(\App\Models\TaxKey::class);
    }

    public function taxScheme()
    {
        return $this->belongsTo(\App\Models\TaxScheme::class);
    }
}
