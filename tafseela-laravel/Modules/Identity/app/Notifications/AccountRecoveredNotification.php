<?php

namespace Modules\Identity\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountRecoveredNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly int $userId,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('identity::notifications.account_recovered.subject'))
            ->line(__('identity::notifications.account_recovered.body'));
    }
}
