<?php

namespace Modules\Identity\app\Listeners;

use Modules\Identity\app\Events\AccountVerifiedEvent;

class AccountVerifiedEventListener
{
    public function handle(AccountVerifiedEvent $event): void {}
}
