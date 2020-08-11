<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\TaxSchemeRequest;

use App\Http\Controllers\Controller;
use App\Models\TaxSchemeAssociation;
use App\Models\TaxKey;
use App\Models\TaxScheme;
use App\Repositories\TaxSchemeRepository;
use App\Repositories\TaxSchemeAssociationRepository;
use App\Repositories\TaxkeyRepository;

class TaxSchemeController extends Controller
{
    public function __construct(
        TaxSchemeRepository $taxSchemeRepository,
        TaxSchemeAssociationRepository $taxSchemeAssociationRepository,
        TaxkeyRepository $taxKeyRepository
    ) {
        $this->repository = $taxSchemeRepository;
        $this->taxSchemeAssociationRepository = $taxSchemeAssociationRepository;
        $this->taxKeyRepository = $taxKeyRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return $this->repository->byTaxScheme();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TaxSchemeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaxSchemeRequest $request)
    {
        $data = $this->repository->createUpdateForTaxScheme($request);

        return response()->json($data, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->taxSchemeAssociationRepository->deleteForTaxSchemeId($id);
        $this->repository->find($id)->delete($id);
        return response()->json('', 204);
    }
}
