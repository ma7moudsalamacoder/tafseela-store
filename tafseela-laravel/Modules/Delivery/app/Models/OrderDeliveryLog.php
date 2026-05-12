<?php

namespace Modules\Delivery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDeliveryLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'order_delivery_id',
        'status',
        'timestamp',
    ];

    protected function casts(): array
    {
        return [
            'timestamp' => 'datetime',
        ];
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(OrderDelivery::class, 'order_delivery_id');
    }
}
