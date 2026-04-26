<?php

namespace Modules\Identity\Listeners;

use Modules\Identity\Events\RecoveryRequestedEvent;

class RecoveryRequestedEventListener
{
    public function handle(RecoveryRequestedEvent $event): void {}
}

