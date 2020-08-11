<?php

namespace App\Repositories;

use DB;
use App\User;
use App\Models\Profile;
use App\Models\AccessLog;
use App\Models\Invite;
use App\Models\UserProfile;
use App\Mail\UserActivation;
use Illuminate\Http\Request;
use App\Models\CountrySetting;
use App\Models\UserPermission;
use Laravel\Passport\ClientRepository;
use App\Repositories\Eloquent\Repository;
use App\Repositories\Contracts\RepositoryInterface;

class UserRepository extends Repository implements RepositoryInterface
{

    /**
     *
     * @return mixed
     */
    public function model()
    {
        return '\App\User';
    }

    public function store(Request $request)
    {
        $user = null;

        DB::transaction(function () use ($request, &$user) {
            $user = User::create([
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'activation_token' => $this->getActivationToken(),
            ]);

            $userPermissions = UserPermission::updateOrCreate([
                'user_id' => $user->id,
                'user_permission_type_id' => $request->user_permission_type_id ?? User::CLIENT_PERMISSION_ID,
            ]);

            $profile = $this->storeProfile($request, $user, $userPermissions);

            $clients = new ClientRepository;
            $client = $clients->create($user->id, $profile->first_name .' '. $profile->last_name, '');

            $userProfile = UserProfile::updateOrCreate([
                'profile_id' => $profile->id,
                'user_id' => $user->id,
            ]);

            //store access log
            AccessLog::store('register', [
              'user_id' => $user->id,
              'profile_id' => $profile->id,
            ]);

            $this->sendActivationMail($request, $user);
        });

        return $user;
    }

    private function storeProfile(Request $request, User $user, UserPermission $userPermissions)
    {
        $type = str_replace('-full', '', optional($userPermissions->userPermissionType)->name);
        $profile = Profile::create([
            'country_id' => SYSTEM_COUNTRY_ID,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => optional($request)->address,
            'city' => optional($request)->city,
            'postal_code' => optional($request)->postal_code,
            'identity_data' => optional($request)->civic_number,
            'type' => $type,
            'confirmed_by_user_id' => $user->id,
            'telephone_number' => $request->telephone_number,
            'address_country_id' => $request->country ?? SYSTEM_COUNTRY_ID,
            'profession_id' => optional($request)->profession_id,
        ]);

        return $profile;
    }

    private function sendActivationMail(Request $request, User $user)
    {
        $mailFromAddress = CountrySetting::getOne('CONTACT_EMAIL');
        $mailFromName = CountrySetting::getOne('MAIL_FROM_NAME');

        $defaultLogo = CountrySetting::getOne('DEFAULT_LOGO') ?? 'default';
        $countryLogo = '/assets/images/logos/logo-'.$defaultLogo.'.png';

        $data = [
            'user' => $user,
            'link' => $request->url . '/'. $user->activation_token,
            'email' => $mailFromAddress,
            'name' => $mailFromName,
            'countryLogo' => $countryLogo,
        ];

        \Mail::to($user->email)->send(new UserActivation($data));
    }

    private function getActivationToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    public function createForUser($request)
    {
        $user = parent::create([
            'email' => $request['email'],
            'password' => bcrypt(str_random(6)),
        ]);

        return $user;
    }

    public function search(Request $request)
    {
        $fields = ['first_name', 'last_name', 'email', 'identity_data', 'iban', 'bic', 'telephone_number', 'city',
         'postal_code', 'address'];

        return $this->model->where(function ($search) use ($request, $fields) {
                $search->orWhereHas('profiles', function ($profile) use ($request, $fields) {
                    $profile->where(function ($query) use ($request, $fields) {
                        $query->orWhereRaw('concat(first_name," ",last_name) Like ?', '%'.$request->q.'%');
                        foreach ($fields as $key => $field) {
                            $query->orWhere($field, 'like', '%'.$request->q.'%');
                        }
                    });
                });
        });
    }
    
    public function storeInvited(Request $request)
    {
        $user = $this->findBy('email', $request['email']);
        $user->update([
            'password' => bcrypt($request['password']),
            'activation_token' => $this->getActivationToken(),
        ]);
        $this->sendActivationMail($request, $user);
        return $user;
    }
}
