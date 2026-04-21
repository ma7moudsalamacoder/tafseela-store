<?php

namespace Modules\Delivery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliveryCompany extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
    ];

    public function agents(): HasMany
    {
        return $this->hasMany(DeliveryAgent::class);
    }
}
