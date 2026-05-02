<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Collection;

class CollectionsSeeder extends Seeder
{
    public function run(): void
    {
        $collections = [
            ['title' => 'وصلنا حديثاً', 'cover_image' => null, 'status' => 'show'],
            ['title' => 'رجالي - رسمي', 'cover_image' => null, 'status' => 'show'],
            ['title' => 'رجالي - كاجوال', 'cover_image' => null, 'status' => 'show'],
            ['title' => 'رجالي - رياضي', 'cover_image' => null, 'status' => 'show'],
            ['title' => 'حريمي - شتوي', 'cover_image' => null, 'status' => 'show'],
            ['title' => 'حريمي - صيفي', 'cover_image' => null, 'status' => 'show'],
            ['title' => 'حريمي - رسمي', 'cover_image' => null, 'status' => 'show'],
            ['title' => 'أطفال - جديد', 'cover_image' => null, 'status' => 'show'],
            ['title' => 'أطفال - كاجوال', 'cover_image' => null, 'status' => 'show'],
            ['title' => 'أطفال - مدرسي', 'cover_image' => null, 'status' => 'show'],
            ['title' => 'إكسسوارات', 'cover_image' => null, 'status' => 'show'],
            ['title' => 'إكسسوارات - فاخرة', 'cover_image' => null, 'status' => 'show'],
            ['title' => 'عروض خاصة', 'cover_image' => null, 'status' => 'show'],
            ['title' => 'موسمي - ربيع', 'cover_image' => null, 'status' => 'show'],
            ['title' => 'موسمي - خريف', 'cover_image' => null, 'status' => 'show'],
        ];

        foreach ($collections as $collection) {
            Collection::updateOrCreate(
                ['title' => $collection['title']],
                $collection
            );
        }
    }
}
