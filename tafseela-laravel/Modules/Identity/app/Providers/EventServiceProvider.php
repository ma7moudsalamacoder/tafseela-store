<?php

namespace Modules\Identity\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Identity\Events\AccountCreatedEvent;
use Modules\Identity\Events\AccountLockedEvent;
use Modules\Identity\Events\AccountRecoveredEvent;
use Modules\Identity\Events\AccountUnlockedEvent;
use Modules\Identity\Events\AccountVerifiedEvent;
use Modules\Identity\Events\NewDeviceSessionEvent;
use Modules\Identity\Events\RecoveryRequestedEvent;
use Modules\Identity\Events\SessionStartedEvent;
use Modules\Identity\Events\VerificationFailedEvent;
use Modules\Identity\Listeners\AccountCreatedEventListener;
use Modules\Identity\Listeners\AccountLockedEventListener;
use Modules\Identity\Listeners\AccountRecoveredEventListener;
use Modules\Identity\Listeners\AccountUnlockedEventListener;
use Modules\Identity\Listeners\AccountVerifiedEventListener;
use Modules\Identity\Listeners\NewDeviceSessionEventListener;
use Modules\Identity\Listeners\RecoveryRequestedEventListener;
use Modules\Identity\Listeners\SessionStartedEventListener;
use Modules\Identity\Listeners\VerificationFailedEventListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        AccountCreatedEvent::class => [
            AccountCreatedEventListener::class,
        ],
        AccountLockedEvent::class => [
            AccountLockedEventListener::class,
        ],
        AccountVerifiedEvent::class => [
            AccountVerifiedEventListener::class,
        ],
        RecoveryRequestedEvent::class => [
            RecoveryRequestedEventListener::class,
        ],
        AccountRecoveredEvent::class => [
            AccountRecoveredEventListener::class,
        ],
        AccountUnlockedEvent::class => [
            AccountUnlockedEventListener::class,
        ],
        NewDeviceSessionEvent::class => [
            NewDeviceSessionEventListener::class,
        ],
        SessionStartedEvent::class => [
            SessionStartedEventListener::class,
        ],
        VerificationFailedEvent::class => [
            VerificationFailedEventListener::class,
        ],
    ];

    /**
     * Indicates if events should be discovered.
     *
     * @var bool
     */
    protected static $shouldDiscoverEvents = true;

    /**
     * Configure the proper event listeners for email verification.
     */
    protected function configureEmailVerification(): void {}
}
