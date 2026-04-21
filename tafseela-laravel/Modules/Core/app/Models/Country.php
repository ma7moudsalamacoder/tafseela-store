<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $fillable = [
        'name',
        'code',
        'phone_code',
    ];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
