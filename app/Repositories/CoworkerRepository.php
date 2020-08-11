<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Mail\InviteCoworker;
use App\Models\OrderRow;
use App\Models\CountrySetting;
use App\Helpers\FileHelper;
use App\Repositories\Eloquent\Repository;
use App\Repositories\UserRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\UserProfileRepository;
use App\Repositories\UserPermissionRepository;

use App\User;
use Mail;

use Illuminate\Container\Container as App;

class CoworkerRepository extends Repository
{
    public $perPage = 10;

    public function __construct(
        UserRepository $userRepository,
        ProfileRepository $profileRepository,
        UserProfileRepository $userProfileRepository,
        UserPermissionRepository $userPermissionRepository,
        App $app
    ) {
        parent::__construct($app);
        $this->userRepository = $userRepository;
        $this->profileRepository = $profileRepository;
        $this->userProfileRepository = $userProfileRepository;
        $this->userPermissionRepository = $userPermissionRepository;
    }

    /**
     *
     * @return mixed
     */
    public function model()
    {
        return "\App\User";
    }

    public function createForCoworker(Request $request)
    {
        $user = null;
        \DB::transaction(function () use ($request, &$user) {
            $file = $request->image;
            $user = $this->userRepository->createForUser($request);
            $profile = $this->profileRepository->createForProfile($request, $user);
            $userProfile = $this->userProfileRepository->createForUserProfile($profile->id, $user->id);
            $userPermission = $this->userPermissionRepository->createForUserPermission($user->id, 2);
            if ($file) {
                $savedFile = FileHelper::uploadBase64File($file, 0, null, $user->id);
            }
        });

        return $user;
    }

    public function sendInvitationEmail($request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $token = str_random(40);
        $link = \CommonHelper::frontEndUrl(URL_LANG.'/registor/'.$token);
        $defaultLogo = CountrySetting::getOne('DEFAULT_LOGO') ?? 'default';
        $countryLogo = '/assets/images/logos/logo-'.$defaultLogo.'.png';

        $data = [
            'first name' => $request->first_name,
            'last name' => $request->last_name,
            'project' => '',
            'company' => '',
            'registration link' => $link,
            'invited by email' => $user->email,
            'invited by first name' => $profile->first_name,
            'invited by last name' => $profile->last_name,
            'countryLogo' => $countryLogo,
        ];

        Mail::to($request->email)->send(new InviteCoworker($data));
    }

    public function hasClient()
    {
        $this->model->client();
        return $this;
    }

    public function search($search)
    {
        return $this->model->whereHas('profiles', function ($query) use ($search) {
            $query->where('email', 'Like', '%'.$search.'%')
            ->orWhereRaw('concat(first_name," ",last_name) Like ?', '%'.$search.'%');
        });
    }
}
