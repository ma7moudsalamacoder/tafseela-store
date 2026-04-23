<?php

namespace Modules\Identity\app\Listeners;

use Modules\Identity\app\Events\AccountRecoveredEvent;

class AccountRecoveredEventListener
{
    public function handle(AccountRecoveredEvent $event): void {}
}
