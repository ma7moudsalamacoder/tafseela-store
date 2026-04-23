<?php

namespace Modules\Identity\app\Enums;

enum OtpActions: string
{
    case VERIFY_EMAIL = 'verify_email';
    case FORGET_PASSWORD = 'forget_password';
    case CONFIRM_2FA = 'confirm_2fa';
    case CONFIRM_PAYMENT = 'confirm_payment';
}
