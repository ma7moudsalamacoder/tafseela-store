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
        'cover_image',
        'status',
    ];

    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
