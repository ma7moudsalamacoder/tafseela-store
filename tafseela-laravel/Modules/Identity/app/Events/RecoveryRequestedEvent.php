<?php

namespace Modules\Identity\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RecoveryRequestedEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public string $otp,
        public string $hash,
        public int $userId,
    ) {}
}
