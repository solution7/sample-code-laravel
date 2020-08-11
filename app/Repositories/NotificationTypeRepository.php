<?php

namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use Illuminate\Http\Request;

use App\Models\NotificationSetting;

class NotificationTypeRepository extends Repository
{
    /**
     *
     * @return mixed
     */
    public function model()
    {
        return "\App\Models\NotificationType";
    }
}
