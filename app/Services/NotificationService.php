<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Notification;

class NotificationService
{
    public function sendNotification($notifiable, $notification)
    {
        if ($notifiable) {
            $notifiable->notify($notification);
        }
    }
}
