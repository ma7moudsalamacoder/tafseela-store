<?php

namespace Modules\Identity\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Traits\HasAuditions;

class AccessLock extends Model
{
    use HasAuditions;

    protected $fillable = [
        'user_id',
        'reason',
        'hash',
        'ip_address',
        'device',
    ];

    protected function casts(): array
    {
        return [
            'hash' => 'string',
            'ip_address' => 'string',
            'device' => 'string',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
