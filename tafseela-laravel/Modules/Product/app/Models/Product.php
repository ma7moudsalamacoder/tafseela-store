<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Traits\HasAuditions;

class Product extends Model
{
    use HasAuditions;

    protected $fillable = [
        'name',
        'category_id',
        'subcategory_id',
        'collection_id',
        'tags',
        'price',
        'fabric',
        'notes',
        'cover_image',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'price' => 'decimal:2',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(ProductDetail::class);
    }

    public function discounts(): HasMany
    {
        return $this->hasMany(ProductDiscount::class, 'item_id');
    }

    public function getActiveDiscountAttribute()
    {
        return $this->discounts()
            ->where(function ($q) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', now());
            })
            ->first();
    }

    public function getDiscountedPriceAttribute()
    {
        $discount = $this->active_discount;

        if (!$discount) {
            return $this->price;
        }

        if ($discount->type === 'rate') {
            return $this->price * (1 - $discount->value / 100);
        }

        return max(0, $this->price - $discount->value);
    }
}
