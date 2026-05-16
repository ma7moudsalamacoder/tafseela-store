<?php

namespace Modules\Identity\Listeners;

use Modules\Identity\Events\NewDeviceSessionEvent;

class NewDeviceSessionEventListener
{
    public function handle(NewDeviceSessionEvent $event): void {}
}
