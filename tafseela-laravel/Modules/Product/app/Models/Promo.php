<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasAuditions;

class Promo extends Model
{
    use HasAuditions;

    protected $primaryKey = 'promo_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'promo_code',
        'used',
        'total',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'used' => 'integer',
            'total' => 'integer',
        ];
    }
}
