<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasAuditions;

class SiteSetting extends Model
{
    use HasAuditions;

    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'value' => 'array',
        ];
    }
}
