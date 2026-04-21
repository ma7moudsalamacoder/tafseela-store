<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Traits\HasAuditions;

class Product extends Model
{
    use HasAuditions;

    protected $fillable = [
        'name',
        'category_id',
        'collection_id',
        'tags',
        'price',
        'stock_qty',
        'image',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'price' => 'decimal:2',
            'stock_qty' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }
}
