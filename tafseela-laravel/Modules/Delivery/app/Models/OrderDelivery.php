<?php

namespace Modules\Delivery\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Traits\HasAuditions;
use Modules\Identity\Models\User;
use Modules\Identity\Models\UserLocation;
use Modules\Order\Models\Order;

class OrderDelivery extends Model
{
    use HasUuids, HasAuditions;

    protected $fillable = [
        'order_id',
        'customer_id',
        'user_location_id',
        'delivery_man_id',
        'status',
        'reason',
        'confirmed',
    ];

    protected function casts(): array
    {
        return [
            'confirmed' => 'boolean',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(UserLocation::class, 'user_location_id');
    }

    public function deliveryMan(): BelongsTo
    {
        return $this->belongsTo(User::class, 'delivery_man_id');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(OrderDeliveryLog::class);
    }
}
