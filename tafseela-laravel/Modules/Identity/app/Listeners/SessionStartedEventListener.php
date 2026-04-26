<?php

namespace Modules\Identity\Listeners;

use Modules\Identity\Events\SessionStartedEvent;

class SessionStartedEventListener
{
    public function handle(SessionStartedEvent $event): void {}
}

