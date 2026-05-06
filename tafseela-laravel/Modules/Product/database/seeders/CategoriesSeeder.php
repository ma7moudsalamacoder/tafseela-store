<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Category;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['category' => 'رجالي', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'حريمي', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'أطفال', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'إكسسوارات', 'cover_image' => null, 'status' => 'show'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['category' => $category['category']],
                $category
            );
        }
    }
}
