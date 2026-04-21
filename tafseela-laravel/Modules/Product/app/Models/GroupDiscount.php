<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Traits\HasAuditions;

class GroupDiscount extends Model
{
    use HasAuditions;

    protected $fillable = [
        'item_id', // Often used as a trigger product or reference
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

    public function details(): HasMany
    {
        return $this->hasMany(GroupDiscountDetail::class);
    }
}
