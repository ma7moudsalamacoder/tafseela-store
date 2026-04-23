<?php

namespace Modules\Identity\app\Listeners;

use Modules\Identity\app\Events\VerificationFailedEvent;

class VerificationFailedEventListener
{
    public function handle(VerificationFailedEvent $event): void
    {
        //
    }
}
