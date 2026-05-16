<?php

namespace Modules\Identity\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\City;
use Modules\Core\Models\Country;

class UserLocation extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'label',
        'recipient_name',
        'recipient_phone',
        'country_id',
        'city_id',
        'state',
        'district',
        'street',
        'address_line_1',
        'address_line_2',
        'building_no',
        'floor_no',
        'apartment_no',
        'postal_code',
        'landmark',
        'latitude',
        'longitude',
        'delivery_notes',
        'is_default',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'is_default' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
