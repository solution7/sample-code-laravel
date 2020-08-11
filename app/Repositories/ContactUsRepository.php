<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;

use Illuminate\Http\Request;
use App\Models\CountrySetting;
use App\Mail\NotifyFrilans;
use Mail;

class ContactUsRepository extends Repository
{

    /**
     *
     * @return mixed
     */
    public function model()
    {
        return "\App\Models\Contact";
    }

    public function setCountryLogo()
    {
        $defaultLogo = CountrySetting::getOne('DEFAULT_LOGO') ?? 'default';
        $countryLogo = '/assets/images/logos/logo-'.$defaultLogo.'.png';

        return $countryLogo;
    }

    public function createForContact($request)
    {
        $this->model->create($request);
    }

    public function sendNotifyEmail($request)
    {
        $contactEmail = CountrySetting::getOne('CONTACT_EMAIL');
        Mail::to($contactEmail)->send(new NotifyFrilans($request));
    }
}
