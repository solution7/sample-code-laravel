<?php

namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use Illuminate\Http\Request;
use App\User;
use App\Models\Customer;
use App\Models\Profile;
use App\Models\CustomerAddress;

class CustomerRepository extends Repository
{

    /**
     *
     * @return mixed
     */
    public function model()
    {
        return '\App\Models\Customer';
    }

    public function byProfile($id)
    {
        return  $this->model->usersCustomer()->where('profile_id', $id);
    }

    public function createOrUpdateCustomer($request)
    {
        $user = $request->has('user_id') ? User::findOrFail($request->user_id) : $request->user();
        $profile_id = $request->profile_id ?? $user->profile->id;

        $customer = $this->model->updateOrCreate(['id' => $request->id], [
            'profile_id' => $profile_id,
            'country_id' => SYSTEM_COUNTRY_ID,
            'vat_number' => optional($request)->vat_number,
            'name' => $request->name,
            'email' => $request->email,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'city' => $request->city,
            'telephone_number' => $request->telephone_number,
            'co' => optional($request)->co,
            'invoicing' => $request->invoicing,
            'due_days' => $request->due_days,
            'customer_type_id' => $request->customer_type_id ?? Customer::USERS_CUSTOMER
        ]);

        return $customer;
    }

    public function deleteCustomer($id)
    {
        $customer = $this->findOrFail($id);

        $customer->addresses()->delete();
        $customer->delete();
    }

    public function searchForCustomers($request)
    {
        return $this->model->search($request);
    }
}
