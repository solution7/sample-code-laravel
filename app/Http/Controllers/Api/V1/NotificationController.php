<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NotificationSettingRequest;
use App\Models\NotificationType;
use App\Models\NotificationSetting;
use App\Repositories\NotificationTypeRepository;
use App\Repositories\NotificationSettingRepository;
use App\Repositories\Eloquent\Repository;

class NotificationController extends Controller
{
    public function __construct(
        NotificationTypeRepository $notificationTypeRepository,
        NotificationSettingRepository $notificationSettingRepository
    ) {
        $this->repository = $notificationTypeRepository;
        $this->notificationSettingRepository = $notificationSettingRepository;
    }

    public function index(Request $request)
    {
        return $this->repository->index($request);
    }

    public function store(NotificationSettingRequest $request)
    {
        $notificationSetting = $this->notificationSettingRepository->updateOrCreate($request);

        return response()->json($notificationSetting);
    }
}
