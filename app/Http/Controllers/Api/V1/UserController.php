<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\InvitedUserRequest;
use App\Http\Requests\TryoutUserRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use \Laravel\Passport\ClientRepository;

use App\User;
use App\Models\Profile;
use App\Models\UserProfile;
use App\Models\UserPermission;
use App\Models\CountrySetting;
use App\Mail\UserActivation;
use App\Models\AccessLog;
use App\Models\Invite;

use CommonHelper;
use Validator;

use App\Repositories\UserRepository;
use App\Repositories\InviteRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\UserProfileRepository;
use App\Repositories\NotificationSettingRepository;

class UserController extends Controller
{
    public static $perPage = 10;

    public function __construct(
        UserRepository $userRepository,
        ProfileRepository $profileRepository,
        UserProfileRepository $userProfileRepository,
        NotificationSettingRepository $notificationSettingRepository,
        InviteRepository $inviteRepository
    ) {
        $this->repository = $userRepository;
        $this->profileRepository = $profileRepository;
        $this->userProfileRepository = $userProfileRepository;
        $this->notificationSettingRepository = $notificationSettingRepository;
        $this->inviteRepository = $inviteRepository;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cleanShow(Request $request)
    {
        return $this->repository->show($request);
    }

    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $users = User::Orderby('created_at', 'desc')
        ->paginate(self::$perPage);

        return response()->json($users);
    }

    public function getClients(Request $request)
    {
        $user = $request->user();
        $clients = [];
        if ($request->has('q') && !empty($request->q)) {
            // Search Clients
            $request['filter'] = 'client';
            $clients = $this->repository->filter($request);
            $clients = $clients->search($request);
            $clients = $clients->paginate(self::$perPage);
        }
        return response()->json($clients);
    }

    public function store(UserRequest $request)
    {
        $user = $this->repository->store($request);
        $this->notificationSettingRepository->registerCoworkerNotificationMail($user);

        return response()->json($user, 201);
    }

    public function storeInvitedUser(InvitedUserRequest $request)
    {
        $user = $this->repository->storeInvited($request);
        $this->inviteRepository->update(['token' => null], $user->profile->id, 'invited_profile_id');

        return response()->json($user, 201);
    }

    public function create(TryoutUserRequest $request)
    {
        $userRequest = new UserRequest($request->all());
        $userRequest->request->add($request->all());

        $user = $this->store($userRequest);

        $profile = $user->profile;

        unset($profile->email);

        if ($profile) {
            $profile->update([
                'iban' => $request->iban,
                'bic' => $request->bic,
                'tax_key_id' => $request->tax_key_id,
                'profession_id' => $request->profession_id,
            ]);
        }

        return response()->json($user);
    }

    public function update(ResetPasswordRequest $request)
    {
        $user = $request->user('api');

        if ($user) {
            $user->update(['password' => bcrypt($request->password)]);
            return response()->json($user, 200);
        } else {
            $reset = \DB::table("password_resets")->where('email', $request->email)->first();
            if (!$reset) {
                return response()->json([
                    'message'=> 'common.InvalidData' ,'errors' => ['email' => ['auth.invalidEmail']]
                ], 422);
            }

            if ($request->token == $reset->token) {
                $user = User::where('email', $request->email)->firstOrFail();
                $user->update(['password' => bcrypt($request->password)]);
                \DB::table("password_resets")->where('email', $request->email)->delete();

                if ($user && $user->activated == 0) {
                    $user->update(['activated' => 1]);
                }

                return response()->json($user, 200);
            } else {
                return response()->json([
                    'message'=> 'common.InvalidData' ,'errors' => ['email' => ['auth.invalidToken']]
                ], 422);
            }
        }
    }

    public function activateUser(Request $request)
    {
        $user = User::where('activation_token', $request->token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }
        if ($user) {
            $user->update(['activated' => 1]);
        }
        return  response()->json($user);
    }

    public function getLoggedInUser(Request $request)
    {
        // TODO: add proper validation that these things exists and throw exception if they don't
        $user = $request->user();
        $profile = $user->profile;

        // If user login to other country with international credential
        if (!$profile) {
            // If the user does not have a profile for the current country.
            // This will create a new user profile for current country

            $profile = $this->profileRepository->createForProfile($user->userProfile->defaultProfile, $user);
            $userProfile = $this->userProfileRepository->createForUserProfile($profile->id, $user->id);
        }

        $output = [
            'user_id' => $user->id,
            'profile_id' => $profile->id,
            'first_name' => $profile->first_name,
            'last_name' => $profile->last_name,
            'email' => $user->email,
            'telephone_number' => $profile->telephone_number,
            'default_taxkey_id' => $profile->tax_key_id,
            'profession_id' => $profile->profession_id,
            'address' => $profile->address,
            'postal_code' => $profile->postal_code,
            'identity_data' => $profile->identity_data,
            'iban' => $profile->iban,
            'bic' => $profile->bic,
            'user_permission_type_id' => $user->userPermission->pluck('user_permission_type_id'),
            'notifications' => $profile->notifications
        ];

        return response()->json($output);
    }

    public function getInvitedUser(Request $request, $token)
    {
        return $this->inviteRepository->getByToken($token);
    }
}
