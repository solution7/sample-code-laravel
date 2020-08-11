<?php

namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Models\OrderRow;
use App\Mail\InviteAdministrator;

use App\Models\CountrySetting;
use Mail;

class AdministratorRepository extends Repository
{
    /**
     *
     * @return mixed
     */
    public function model()
    {
        return "\App\User";
    }

    public function search($search)
    {
        $this->model->whereHas('profiles', function ($query) use ($search) {
            $query->whereRaw('concat(first_name," ",last_name) Like ?', '%'.$search.'%');
            $query->orWhere('email', 'like', '%'.$search.'%');
        });

        return $this;
    }

    public function getAdministators()
    {
        return $this->model->select('users.*')
            ->join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
            ->join('profiles', 'profiles.id', '=', 'user_profiles.profile_id')
            ->join('user_permissions', 'user_permissions.user_id', '=', 'users.id')
            ->groupBy('users.id')->orderBy('profiles.last_name');
    }

    public function sendInvitationEmail($request, $invited)
    {
        $profile = $invited->inviteeProfile;
        $token = $invited->token;
        $link = \CommonHelper::frontEndUrl(URL_LANG.'/register/'.$token);
        $defaultLogo = CountrySetting::getOne('DEFAULT_LOGO') ?? 'default';
        $countryLogo = '/assets/images/logos/logo-'.$defaultLogo.'.png';

        $data = [
            'first name' => $request->first_name,
            'last name' => $request->last_name,
            'registration link' => $link,
            'invited by email' => optional($profile)->email,
            'invited by first name' => optional($profile)->first_name,
            'invited by last name' => optional($profile)->last_name,
            'countryLogo' => $countryLogo,
            'project' => $request->project ?? '',
            'company' => $request->company ?? 'Invoicery AB',
        ];

        Mail::to($request->email)->send(new InviteAdministrator($data));
    }
}
