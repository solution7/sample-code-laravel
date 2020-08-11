<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;

use App\Mail\JobApplicationEmail;

use App\Models\JobPosition;
use App\Models\Language;
use App\Models\CountrySetting;

class JobPositionRepository extends Repository
{

    public $perPage = 10;
    /**
     *
     * @return mixed
     */
    public function model()
    {
        return "\App\Models\JobPosition";
    }

    public function createJob($request)
    {
        $user = $request->user();
        $lang_id = Language::getLangIDByCode(str_replace('/', '', SITE_LANG));

        return parent::create([
              'country_id' => SYSTEM_COUNTRY_ID,
              'language_id' => $lang_id,
              'user_id' => $user->id,
              'subject' => $request->subject,
              'content' => $request->content,
          ]);
    }

    public function updateJob($request, $id)
    {
        $this->findOrFail($id);

         parent::update([
              'subject' => $request->subject,
              'content' => $request->content,
          ], $id);

          return $this->findOrFail($id);
    }

    public function applyForJob($request)
    {
        $request->request->remove('privacy_policy');

        $defaultLogo = CountrySetting::getOne('DEFAULT_LOGO') ?? 'default';
        $countryLogo = '/assets/images/logos/logo-'.$defaultLogo.'.png';

        $data = [
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'subject' => $request->subject,
            'resume' => $request->resume,
            'countryLogo' => $countryLogo
        ];

        $contactEmail = CountrySetting::getOne('CONTACT_EMAIL');
        \Mail::to($contactEmail)->send(new JobApplicationEmail($data));

        return $data;
    }
}
