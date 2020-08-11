<?php

namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use Illuminate\Http\Request;

use App\User;
use App\Models\Order;
use App\Mail\Notification;
use App\Models\CountrySetting;
use App\Models\NotificationType;
use Mail;

class NotificationSettingRepository extends Repository
{
    /**
    * Specify Model class name
    *
    * @return mixed
    */
    public function model()
    {
        return "\App\Models\NotificationSetting";
    }

    public function updateOrCreate(Request $request)
    {
        $notificationSetting = $this->model()::updateOrCreate([
            'notification_type_id' => $request->id,
            'profile_id' => $request->profile_id
        ], [
            'data' => json_encode(['status' => $request->status])
        ]);

        return $notificationSetting;
    }

    public function registerCoworkerNotificationMail($userInfo)
    {
        $emailData['content'] = __('email.RegisteredCoworkerMessage');
        $emailData['subject'] = __('email.RegisteredCoworkerSubject');

        $this->sendNotification($emailData, NotificationType::REGISTER_COWORKER);
    }

    public function newWorkOrderNotificationMail($order)
    {
        $emailData['content'] = __('email.NewWorkorderMessage');
        $emailData['subject'] = __('email.NewWorkorderSubject');

        $this->sendNotification($emailData, NotificationType::CREATE_WORKORDER);
    }

    private function sendNotification($emailData, $typeId)
    {
        $users = User::administrator()->whereHas('profiles', function ($q) {
            $q->whereHas('notifications');
        })->get();

        foreach ($users as $user) {
            $notification = $user->profile->notifications->where('notification_type_id', $typeId)->first();

            if ($notification) {
                $status = json_decode($notification->data, true)['status'];

                if ($status) {
                    $defaultLogo = CountrySetting::getOne('DEFAULT_LOGO') ?? 'default';

                    $data = [
                        'first name' => $user->profile->first_name,
                        'project name' => '',
                        'login link'   => \CommonHelper::frontEndUrl(URL_LANG.'/login'),
                        'contact email' => '',
                        'countryLogo'  => '/assets/images/logos/logo-'.$defaultLogo.'.png'
                    ];

                    Mail::to($user->email)->send(new Notification($data, $emailData));
                }
            }
        }
    }
}
