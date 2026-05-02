<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Category;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['category' => 'رجالي', 'subcategory' => 'قمصان', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'رجالي', 'subcategory' => 'بناطيل', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'رجالي', 'subcategory' => 'جواكت', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'رجالي', 'subcategory' => 'تيشيرتات', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'رجالي', 'subcategory' => 'سراويل قصيرة', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'رجالي', 'subcategory' => 'ملابس داخلية', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'حريمي', 'subcategory' => 'فساتين', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'حريمي', 'subcategory' => 'بلوزات', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'حريمي', 'subcategory' => 'تنانير', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'حريمي', 'subcategory' => 'بناطيل', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'حريمي', 'subcategory' => 'ملابس داخلية', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'أطفال', 'subcategory' => 'أولاد', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'أطفال', 'subcategory' => 'بنات', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'أطفال', 'subcategory' => 'رضع', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'إكسسوارات', 'subcategory' => null, 'cover_image' => null, 'status' => 'show'],
            ['category' => 'إكسسوارات', 'subcategory' => 'حقائب', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'إكسسوارات', 'subcategory' => 'مجوهرات', 'cover_image' => null, 'status' => 'show'],
            ['category' => 'إكسسوارات', 'subcategory' => 'نظارات', 'cover_image' => null, 'status' => 'show'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                [
                    'category' => $category['category'],
                    'subcategory' => $category['subcategory'],
                ],
                $category
            );
        }
    }
}
