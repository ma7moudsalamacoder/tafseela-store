<?php

namespace Modules\Identity\Listeners;

use Modules\Identity\Events\VerificationFailedEvent;

class VerificationFailedEventListener
{
    public function handle(VerificationFailedEvent $event): void
    {
        //
    }
}
