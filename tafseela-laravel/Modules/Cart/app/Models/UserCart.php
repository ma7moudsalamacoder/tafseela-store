<?php

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Traits\HasAuditions;
use Modules\Identity\Models\User;

class UserCart extends Model
{
    use HasAuditions;

    protected $fillable = [
        'user_id',
        'content',
    ];

    protected function casts(): array
    {
        return [
            'content' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
