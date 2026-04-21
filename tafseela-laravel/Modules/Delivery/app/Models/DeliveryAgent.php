<?php

namespace Modules\Delivery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Traits\HasAuditions;
use Modules\Identity\Models\User;

class DeliveryAgent extends Model
{
    use HasAuditions;

    protected $fillable = [
        'user_id',
        'type',
        'delivery_company_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(DeliveryCompany::class, 'delivery_company_id');
    }
}
