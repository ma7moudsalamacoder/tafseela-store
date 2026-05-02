<?php

namespace Modules\Identity\Listeners;

use Modules\Identity\Events\AccountVerifiedEvent;

class AccountVerifiedEventListener
{
    public function handle(AccountVerifiedEvent $event): void {}
}


