<?php

namespace Modules\Identity\app\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VerificationFailedEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public int $userId,
    ) {}
}
