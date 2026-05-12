<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Traits\HasAuditions;

class ProductDiscount extends Model
{
    use HasAuditions;

    protected $fillable = [
        'item_id',
        'managed_by',
        'type',
        'value',
        'start_date',
        'end_date',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'decimal:2',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'item_id');
    }

    public function scopeActive($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('start_date')->orWhere('start_date', '<=', now());
        })->where(function ($q) {
            $q->whereNull('end_date')->orWhere('end_date', '>=', now());
        });
    }

    public static function hasActiveDiscounts(): bool
    {
        return self::active()->exists();
    }
}
