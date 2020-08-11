<?php

namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use Illuminate\Http\Request;
use Illuminate\Container\Container as App;
use App\Models\Invite;
use App\Models\UserPermissionType;

use App\Repositories\UserRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\UserProfileRepository;
use App\Repositories\UserPermissionRepository;

class InviteRepository extends Repository
{

    public function __construct(
        App $app,
        UserRepository $userRepository,
        ProfileRepository $profileRepository,
        UserProfileRepository $userProfileRepository,
        UserPermissionRepository $userPermissionRepository
    ) {
        $this->userRepository = $userRepository;
        $this->profileRepository = $profileRepository;
        $this->userProfileRepository = $userProfileRepository;
        $this->userPermissionRepository = $userPermissionRepository;

        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return "\App\Models\Invite";
    }

    public function store($request)
    {
        $invited = null;

        \DB::transaction(function () use ($request, &$invited) {
            $user = $this->userRepository->createForUser($request);

            $profile = $this->profileRepository->create([
                'country_id' => SYSTEM_COUNTRY_ID,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'type' => $request->invite_type,
                'address_country_id' => SYSTEM_COUNTRY_ID
            ]);

            $userProfile = $this->userProfileRepository->createForUserProfile($profile->id, $user->id);
            $userPermission = $this->userPermissionRepository->createForUserPermission(
                $user->id,
                $request->user_permission_id
            );

            $invited = $this->createForInvite($request, $profile);
        });

        return $invited;
    }

    public function createForInvite($request, $profile)
    {
        $data = [
            'user_permission_id' => $request->user_permission_id,
            'invitee_profile_id' => $request->invitee_profile_id,
            'invited_profile_id' => $profile->id,
            'invite_type' => $request->invite_type,
            'token' => str_random(40),
            'sent' => date('Y-m-d H:i:s'),
        ];

        if ($request->project_id) {
            $data['data'] = json_encode(['project_id' => $request->project_id]);
        }

        return $this->create($data);
    }

    public function getByToken($token)
    {
        $invited = $this->findBy('token', $token);

        $output = [
            'first_name' => optional($invited->invitedProfile)->first_name,
            'last_name' => optional($invited->invitedProfile)->last_name,
            'email' => optional($invited->invitedProfile)->email,
            'user_permission_type_id' => $invited->user_permission_id
        ];

        return response()->json($output);
    }
}
