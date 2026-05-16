<?php

namespace Modules\Identity\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Traits\HasAuditions;
use Modules\Identity\Enums\OtpActions;

class Otp extends Model
{
    use HasAuditions;

    protected $fillable = [
        'user_id',
        'hash',
        'otp_code',
        'action',
        'expires_at',
        'attempts',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'attempts' => 'integer',
            'action' => OtpActions::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
