<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Traits\HasAuditions;
use Modules\Identity\Models\User;
use Modules\Product\Models\Promo;

class Order extends Model
{
    use HasAuditions;

    protected $fillable = [
        'user_id',
        'promo_code',
        'status',
        'grand_total',
        'discount',
        'tax',
    ];

    protected function casts(): array
    {
        return [
            'grand_total' => 'decimal:2',
            'discount' => 'decimal:2',
            'tax' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function promo(): BelongsTo
    {
        return $this->belongsTo(Promo::class, 'promo_code', 'promo_code');
    }

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}
