<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Traits\HasAuditions;

class Category extends Model
{
    use HasAuditions;

    protected $fillable = [
        'category',
        'subcategory',
        'cover_image',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
