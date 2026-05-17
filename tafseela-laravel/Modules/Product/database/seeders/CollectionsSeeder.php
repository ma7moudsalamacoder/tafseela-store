<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Collection;

class CollectionsSeeder extends Seeder
{
    public function run(): void
    {
        $collections = [
            ['title' => 'وصلنا حديثاً', 'slug' => 'new-arrivals', 'cover_image' => 'https://images.unsplash.com/photo-1567400353410-2e8f02b2e4b6?w=400', 'status' => 'show'],
            ['title' => 'رجالي - رسمي', 'slug' => 'men-formal', 'cover_image' => 'https://images.unsplash.com/photo-1594930444408-c0a3e8b4a1b0?w=400', 'status' => 'show'],
            ['title' => 'رجالي - كاجوال', 'slug' => 'men-casual', 'cover_image' => 'https://images.unsplash.com/photo-1515886657273-9f2d6e7b0a5c?w=400', 'status' => 'show'],
            ['title' => 'رجالي - رياضي', 'slug' => 'men-sports', 'cover_image' => 'https://images.unsplash.com/photo-1517835294938-f25b8e1b0f5a?w=400', 'status' => 'show'],
            ['title' => 'حريمي - شتوي', 'slug' => 'women-winter', 'cover_image' => 'https://images.unsplash.com/photo-1483985985355-519b8f7f9f3e?w=400', 'status' => 'show'],
            ['title' => 'حريمي - صيفي', 'slug' => 'women-summer', 'cover_image' => 'https://images.unsplash.com/photo-1534525585307-5f8d6c4b2a1e?w=400', 'status' => 'show'],
            ['title' => 'حريمي - رسمي', 'slug' => 'women-formal', 'cover_image' => 'https://images.unsplash.com/photo-1524504736582-9c8b7a6d5e4f?w=400', 'status' => 'show'],
            ['title' => 'أطفال - جديد', 'slug' => 'kids-new', 'cover_image' => 'https://images.unsplash.com/photo-1588348244040-8c9d0e1f2a3b?w=400', 'status' => 'show'],
            ['title' => 'أطفال - كاجوال', 'slug' => 'kids-casual', 'cover_image' => 'https://images.unsplash.com/photo-1541710234765-9a8b7c6d5e4f?w=400', 'status' => 'show'],
            ['title' => 'أطفال - مدرسي', 'slug' => 'kids-school', 'cover_image' => 'https://images.unsplash.com/photo-1578981234987-0a1b2c3d4e5f?w=400', 'status' => 'show'],
            ['title' => 'إكسسوارات', 'slug' => 'accessories', 'cover_image' => 'https://images.unsplash.com/photo-1567890432654-7b8c9d0e1f2a?w=400', 'status' => 'show'],
            ['title' => 'إكسسوارات - فاخرة', 'slug' => 'luxury-accessories', 'cover_image' => 'https://images.unsplash.com/photo-1617126057890-3c4d5e6f7a8b?w=400', 'status' => 'show'],
            ['title' => 'عروض خاصة', 'slug' => 'special-offers', 'cover_image' => 'https://images.unsplash.com/photo-1542211920321-9d0e1f2a3b4c?w=400', 'status' => 'show'],
            ['title' => 'موسمي - ربيع', 'slug' => 'seasonal-spring', 'cover_image' => 'https://images.unsplash.com/photo-1526511909765-0c1d2e3f4a5b?w=400', 'status' => 'show'],
            ['title' => 'موسمي - خريف', 'slug' => 'seasonal-autumn', 'cover_image' => 'https://images.unsplash.com/photo-1432156789543-8a9b0c1d2e3f?w=400', 'status' => 'show'],
        ];

        foreach ($collections as $collection) {
            Collection::updateOrCreate(
                ['title' => $collection['title']],
                $collection
            );
        }
    }
}
