<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use Illuminate\Http\Request;
use App\User;
use App\Models\Customer;
use App\Models\Profile;
use App\Models\CustomerAddress;

class CustomerAddressRepository extends Repository implements RepositoryInterface
{

    /**
     *
     * @return mixed
     */
    public function model()
    {
        return '\App\Models\CustomerAddress';
    }

    public function createOrUpdateCustomerAddress($request, $customer_id, $profile_id)
    {
        $customerAddress = $this->model->updateOrCreate([
          'customer_id' => $customer_id,
          'profile_id' => $profile_id,
          'customer_address_type_id' => $request->customer_address_type_id,
          'email' => $request->email,
          'address_country_id' => $request->address_country_id,
          'postal_code' => $request->postal_code,
          'address' => $request->address,
          'city' => $request->city,
          'reference' => $request->reference,
          'co' => $request->co,
          'invoice_language_id' => $request->invoice_language_id ?? 0,
        ]);

        $customerAddress->updated_at = date("Y-m-d H:i:s");
        $customerAddress->save();
    }
}
