<?php

namespace App\Repositories;

use DB;
use Illuminate\Http\Request;
use App\Models\TaxSchemeAssociation;
use App\Models\TaxKey;
use App\Models\TaxScheme;
use App\Repositories\Eloquent\Repository;
use App\Repositories\TaxSchemeAssociationRepository;
use Illuminate\Container\Container as App;

class TaxSchemeRepository extends Repository
{
    public function __construct(
        TaxSchemeAssociationRepository $taxSchemeAssociationRepository,
        App $app
    ) {
        $this->taxSchemeAssociationRepository = $taxSchemeAssociationRepository;
        parent::__construct($app);
    }

    protected $perPage = 10;
    /**
     *
     * @return mixed
     */
    public function model()
    {
        return '\App\Models\TaxScheme';
    }

    public function byTaxScheme()
    {
        $taxSchemes = $this->model->with('taxAssociation')
            ->select('id', 'name')->take(2)->get();

        $taxSchemes->each(function ($taxScheme, $key) {
            $taxScheme->taxAssociation->each(function ($value, $key) {
                $value['tax_key'] = $value->taxKey;
            });
        });

        return $taxSchemes;
    }

    public function createUpdateForTaxScheme(Request $request)
    {
        $newScheme['name'] = $request->name;
        $newScheme['country_id'] =  SYSTEM_COUNTRY_ID;
        $taxKeyIds = array_filter($request->tax_key);

        $taxScheme = $this->model->updateOrCreate(['id' => $request->id], $newScheme);

        foreach ($request->tax_key as $key => $taxkey) {
            if (!empty($taxkey) && !empty($request->public_name[$key])) {
                $TSA['public_name'] = $request->public_name[$key];
                $TSA['visible'] = ($request->visible[$key]) ? $request->visible[$key] : 1;
                $this->taxSchemeAssociationRepository->createUpdateForTaxSchemeAssociation($taxkey, $taxScheme, $TSA);
            }
        }

        $taxScheme = TaxScheme::with('taxAssociation')
                                ->where('id', $taxScheme->id)->select('id', 'name')->first();
        $taxScheme->taxAssociation->each(function ($value, $key) {
            $value['tax_key'] = $value->taxKey;
        });

        return $taxScheme;
    }
}
