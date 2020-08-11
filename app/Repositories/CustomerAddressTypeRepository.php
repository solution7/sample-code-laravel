<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use Illuminate\Http\Request;
use App\Models\CustomerAddressType;

class CustomerAddressTypeRepository extends Repository implements RepositoryInterface
{

    /**
     *
     * @return mixed
     */
    public function model()
    {
        return '\App\Models\CustomerAddressType';
    }
}
