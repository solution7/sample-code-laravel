<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeductionFile extends Model
{
    protected $guarded = [];

    public function file()
    {
        return $this->belongsTo(\App\Models\File::class);
    }

    public function invoice()
    {
        return $this->belongsTo(\App\Models\Invoice::class);
    }
    
    public static function storeDeductionFile($invoice_id, $file_id)
    {
        $deduction = self::create([
            'invoice_id' => $invoice_id,
            'file_id' => $file_id,
        ]);

        return $deduction;
    }

    public static function store($invoice_id, $file_id)
    {
        $deduction = self::create([
            'invoice_id' => $invoice_id,
            'file_id' => $file_id,
        ]);

        return $deduction;
    }
}
