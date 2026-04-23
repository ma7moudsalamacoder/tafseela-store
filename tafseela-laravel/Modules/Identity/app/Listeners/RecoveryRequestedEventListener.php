<?php

namespace Modules\Identity\app\Listeners;

use Modules\Identity\app\Events\RecoveryRequestedEvent;

class RecoveryRequestedEventListener
{
    public function handle(RecoveryRequestedEvent $event): void {}
}
