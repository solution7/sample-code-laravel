<?php

namespace App\Repositories;

use DB;
use Illuminate\Http\Request;
use App\Models\TaxSchemeAssociation;
use App\Repositories\Eloquent\Repository;

class TaxSchemeAssociationRepository extends Repository
{
    protected $perPage = 10;
    /**
     *
     * @return mixed
     */
    public function model()
    {
        return '\App\Models\TaxSchemeAssociation';
    }

    public function deleteForTaxSchemeId($id)
    {
        //Delete Tax Scheme Association
        $this->model->where('tax_scheme_id', $id)->delete();
    }

    public function createUpdateForTaxSchemeAssociation($taxkey, $taxScheme, $TSA)
    {
        TaxSchemeAssociation::updateOrCreate([
            'tax_key_id' => $taxkey,
            'tax_scheme_id' => $taxScheme->id
        ], $TSA);
    }
}
