<?php

namespace Modules\Identity\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RecoveryRequestedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly string $otp,
        public readonly string $hash,
        public readonly int $userId,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('identity::notifications.recovery_requested.subject'))
            ->line(__('identity::notifications.recovery_requested.body'))
            ->line(__('identity::notifications.recovery_requested.otp_label').' '.$this->otp)
            ->action(__('identity::notifications.recovery_requested.action'), url('/recover?hash='.$this->hash));
    }
}

