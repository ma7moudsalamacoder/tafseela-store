<?php

namespace Modules\Identity\Listeners;

use Modules\Identity\Events\AccountCreatedEvent;

class AccountCreatedEventListener
{
    public function handle(AccountCreatedEvent $event): void {}
}


