<?php

namespace Modules\Identity\Enums;

enum LockReasons: string
{
    case ORIGINAL_USER_REQUEST = 'original_user_request';
    case UNAUTHORIZED_DEVICE = 'unauthorized_device';
    case UNAUTHORIZED_ACCESS = 'unauthorized_access';
}
