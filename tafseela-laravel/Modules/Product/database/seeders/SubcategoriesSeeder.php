<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Category;
use Modules\Product\Models\Subcategory;

class SubcategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $subcategories = [
            ['category' => 'رجالي', 'title' => 'قمصان', 'status' => 'show'],
            ['category' => 'رجالي', 'title' => 'بناطيل', 'status' => 'show'],
            ['category' => 'رجالي', 'title' => 'جواكت', 'status' => 'show'],
            ['category' => 'رجالي', 'title' => 'تيشيرتات', 'status' => 'show'],
            ['category' => 'رجالي', 'title' => 'سراويل قصيرة', 'status' => 'show'],
            ['category' => 'رجالي', 'title' => 'ملابس داخلية', 'status' => 'show'],
            ['category' => 'حريمي', 'title' => 'فساتين', 'status' => 'show'],
            ['category' => 'حريمي', 'title' => 'بلوزات', 'status' => 'show'],
            ['category' => 'حريمي', 'title' => 'تنانير', 'status' => 'show'],
            ['category' => 'حريمي', 'title' => 'بناطيل', 'status' => 'show'],
            ['category' => 'حريمي', 'title' => 'ملابس داخلية', 'status' => 'show'],
            ['category' => 'أطفال', 'title' => 'أولاد', 'status' => 'show'],
            ['category' => 'أطفال', 'title' => 'بنات', 'status' => 'show'],
            ['category' => 'أطفال', 'title' => 'رضع', 'status' => 'show'],
            ['category' => 'إكسسوارات', 'title' => 'حقائب', 'status' => 'show'],
            ['category' => 'إكسسوارات', 'title' => 'مجوهرات', 'status' => 'show'],
            ['category' => 'إكسسوارات', 'title' => 'نظارات', 'status' => 'show'],
        ];

        foreach ($subcategories as $sub) {
            $category = Category::where('category', $sub['category'])->first();
            if ($category) {
                Subcategory::updateOrCreate(
                    ['title' => $sub['title'], 'category_id' => $category->id],
                    ['status' => $sub['status']]
                );
            }
        }
    }
}
