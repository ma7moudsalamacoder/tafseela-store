<?php

namespace Modules\Identity\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Identity\app\Events\AccountCreatedEvent;
use Modules\Identity\app\Events\AccountLockedEvent;
use Modules\Identity\app\Events\AccountRecoveredEvent;
use Modules\Identity\app\Events\AccountUnlockedEvent;
use Modules\Identity\app\Events\AccountVerifiedEvent;
use Modules\Identity\app\Events\NewDeviceSessionEvent;
use Modules\Identity\app\Events\RecoveryRequestedEvent;
use Modules\Identity\app\Events\SessionStartedEvent;
use Modules\Identity\app\Events\VerificationFailedEvent;
use Modules\Identity\app\Listeners\AccountCreatedEventListener;
use Modules\Identity\app\Listeners\AccountLockedEventListener;
use Modules\Identity\app\Listeners\AccountRecoveredEventListener;
use Modules\Identity\app\Listeners\AccountUnlockedEventListener;
use Modules\Identity\app\Listeners\AccountVerifiedEventListener;
use Modules\Identity\app\Listeners\NewDeviceSessionEventListener;
use Modules\Identity\app\Listeners\RecoveryRequestedEventListener;
use Modules\Identity\app\Listeners\SessionStartedEventListener;
use Modules\Identity\app\Listeners\VerificationFailedEventListener;

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
