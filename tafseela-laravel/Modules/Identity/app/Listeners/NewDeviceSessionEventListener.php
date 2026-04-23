<?php

namespace Modules\Identity\app\Listeners;

use Modules\Identity\app\Events\NewDeviceSessionEvent;

class NewDeviceSessionEventListener
{
    public function handle(NewDeviceSessionEvent $event): void {}
}
