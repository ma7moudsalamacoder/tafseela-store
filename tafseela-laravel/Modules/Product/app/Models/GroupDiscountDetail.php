<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Traits\HasAuditions;

class GroupDiscountDetail extends Model
{
    use HasAuditions;

    protected $fillable = [
        'item_id',
        'group_discount_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'item_id');
    }

    public function groupDiscount(): BelongsTo
    {
        return $this->belongsTo(GroupDiscount::class);
    }
}
