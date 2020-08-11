<?php

namespace App\Repositories;

use DB;
use Illuminate\Http\Request;
use App\Models\TaxKey;
use App\Models\CountrySetting;
use App\Repositories\Eloquent\Repository;

class TaxkeyRepository extends Repository
{
    protected $perPage = 10;
    /**
     *
     * @return mixed
     */
    public function model()
    {
        return '\App\Models\TaxKey';
    }

    public function store(Request $request)
    {
        $taxkey = parent::create([
          'name'        => $request->name,
          'value'       => $request->value,
          'country_id'  => SYSTEM_COUNTRY_ID,
          'fee'         => $request->fee,
          'visibility'  => $request->visibility ?? 0,
          'tax'         => $request->tax ?? 0,
          'payroll_tax' => $request->payroll_tax ?? 0,
        ]);

        return $taxkey;
    }

    public function byMainTaxKeys()
    {
        return CountrySetting::getOne('MAIN_TAX_KEYS');
    }
}
