<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use App\Models\UserProfile;

class UserProfileRepository extends Repository
{

    /**
     *
     * @return mixed
     */
    public function model()
    {
        return "\App\Models\UserProfile";
    }

    public function createForUserProfile($profileId, $userId)
    {
        $userProfile = parent::create([
            'profile_id' => $profileId,
            'user_id' => $userId,
        ]);

        return $userProfile;
    }
}
