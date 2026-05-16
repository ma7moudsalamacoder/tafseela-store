<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Traits\HasAuditions;

class ProductDetail extends Model
{
    use HasAuditions;

    protected $fillable = [
        'size',
        'color',
        'cover_image',
        'stock_qty',
        'status',
        'notes',
        'product_id',
    ];

    protected function casts(): array
    {
        return [
            'stock_qty' => 'integer',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
