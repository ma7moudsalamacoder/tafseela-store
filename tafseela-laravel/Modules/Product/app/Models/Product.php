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
        'image',
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
}
