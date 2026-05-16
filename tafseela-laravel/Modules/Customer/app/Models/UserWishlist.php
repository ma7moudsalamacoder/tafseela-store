<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Traits\HasAuditions;
use Modules\Identity\Models\User;

class UserWishlist extends Model
{
    use HasAuditions;

    protected $fillable = [
        'user_id',
        'products',
    ];

    protected function casts(): array
    {
        return [
            'products' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
