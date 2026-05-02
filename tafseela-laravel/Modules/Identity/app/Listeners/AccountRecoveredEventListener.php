<?php

namespace Modules\Identity\Listeners;

use Modules\Identity\Events\AccountRecoveredEvent;

class AccountRecoveredEventListener
{
    public function handle(AccountRecoveredEvent $event): void {}
}


