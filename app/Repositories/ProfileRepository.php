<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use App\Models\Language;
use App\User;

class ProfileRepository extends Repository
{

    /**
     *
     * @return mixed
     */
    public function model()
    {
        return "\App\Models\Profile";
    }

    public function createForProfile($data, User $user)
    {
        $language = Language::where('country_id', SYSTEM_COUNTRY_ID)->first();

        $profile = parent::create([
            'country_id' => SYSTEM_COUNTRY_ID,
            'confirmed_by_user_id' => $user->id,
            'type' => $data->type ?? 'client',
            'first_name' => optional($data)->first_name,
            'last_name' => optional($data)->last_name,
            'address' => optional($data)->address,
            'city' => optional($data)->city,
            'co' => optional($data)->co,
            'iban' => optional($data)->iban,
            'bic' => optional($data)->bic,
            'telephone_number' => optional($data)->telephone_number,
            'address_country_id' => $data->address_country_id ?? SYSTEM_COUNTRY_ID,
            'postal_code' => optional($data)->postal_code,
            'identity_data' => optional($data)->identity_data,
            'language_id' => $language->id,
            'profession_id' => optional($data)->profession_id,
        ]);

        return $profile;
    }
}
