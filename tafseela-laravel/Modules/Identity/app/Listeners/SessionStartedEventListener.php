<?php

namespace Modules\Identity\app\Listeners;

use Modules\Identity\app\Events\SessionStartedEvent;

class SessionStartedEventListener
{
    public function handle(SessionStartedEvent $event): void {}
}
