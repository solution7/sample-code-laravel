<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use App\Models\CountrySetting;
use Mail;

class UserPermissionRepository extends Repository
{

    /**
     *
     * @return mixed
     */
    public function model()
    {
        return "\App\Models\UserPermission";
    }

    public function createForUserPermission($userId, $permissionId)
    {
        $user = parent::create([
            'user_id' => $userId,
            'user_permission_type_id' => $permissionId,
        ]);
        return $user;
    }
}
