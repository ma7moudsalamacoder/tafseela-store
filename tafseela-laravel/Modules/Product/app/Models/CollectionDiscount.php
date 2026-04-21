<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Traits\HasAuditions;

class CollectionDiscount extends Model
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

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class, 'item_id');
    }
}
