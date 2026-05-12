<?php

namespace Modules\Identity\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewDeviceSessionEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public int $userId,
    ) {}
}


