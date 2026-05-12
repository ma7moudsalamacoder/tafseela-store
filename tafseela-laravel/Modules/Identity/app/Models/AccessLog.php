<?php

namespace Modules\Identity\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Traits\HasAuditions;

class AccessLog extends Model
{
    use HasAuditions;

    protected $fillable = [
        'user_id',
        'attempts',
    ];

    protected function casts(): array
    {
        return [
            'attempts' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

