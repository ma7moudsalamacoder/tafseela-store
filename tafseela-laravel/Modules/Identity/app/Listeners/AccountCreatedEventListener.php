<?php

namespace Modules\Identity\app\Listeners;

use Modules\Identity\app\Events\AccountCreatedEvent;

class AccountCreatedEventListener
{
    public function handle(AccountCreatedEvent $event): void {}
}
