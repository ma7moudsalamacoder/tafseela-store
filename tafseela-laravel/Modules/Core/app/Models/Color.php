<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasAuditions;

class Color extends Model
{
    use HasAuditions;

    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'key',
        'labels',
    ];

    protected function casts(): array
    {
        return [
            'labels' => 'array',
        ];
    }
}
