<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Category;
use Modules\Product\Models\Collection;
use Modules\Product\Models\Product;
use Modules\Product\Models\Subcategory;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'mens' => Category::firstWhere('category', 'رجالي'),
            'womens' => Category::firstWhere('category', 'حريمي'),
            'kids' => Category::firstWhere('category', 'أطفال'),
            'accessories' => Category::firstWhere('category', 'إكسسوارات'),
        ];

        $subs = [
            'mens_shirts' => Subcategory::where(['title' => 'قمصان', 'category_id' => $categories['mens']->id])->first(),
            'mens_pants' => Subcategory::where(['title' => 'بناطيل', 'category_id' => $categories['mens']->id])->first(),
            'mens_jackets' => Subcategory::where(['title' => 'جواكت', 'category_id' => $categories['mens']->id])->first(),
            'mens_tshirts' => Subcategory::where(['title' => 'تيشيرتات', 'category_id' => $categories['mens']->id])->first(),
            'mens_shorts' => Subcategory::where(['title' => 'سراويل قصيرة', 'category_id' => $categories['mens']->id])->first(),
            'womens_dresses' => Subcategory::where(['title' => 'فساتين', 'category_id' => $categories['womens']->id])->first(),
            'womens_blouses' => Subcategory::where(['title' => 'بلوزات', 'category_id' => $categories['womens']->id])->first(),
            'womens_skirts' => Subcategory::where(['title' => 'تنانير', 'category_id' => $categories['womens']->id])->first(),
            'womens_pants' => Subcategory::where(['title' => 'بناطيل', 'category_id' => $categories['womens']->id])->first(),
            'boys' => Subcategory::where(['title' => 'أولاد', 'category_id' => $categories['kids']->id])->first(),
            'girls' => Subcategory::where(['title' => 'بنات', 'category_id' => $categories['kids']->id])->first(),
            'babies' => Subcategory::where(['title' => 'رضع', 'category_id' => $categories['kids']->id])->first(),
            'bags' => Subcategory::where(['title' => 'حقائب', 'category_id' => $categories['accessories']->id])->first(),
            'jewelry' => Subcategory::where(['title' => 'مجوهرات', 'category_id' => $categories['accessories']->id])->first(),
            'sunglasses' => Subcategory::where(['title' => 'نظارات', 'category_id' => $categories['accessories']->id])->first(),
        ];

        $collections = [
            'new_arrivals' => Collection::firstWhere('title', 'وصلنا حديثاً'),
            'formal_men' => Collection::firstWhere('title', 'رجالي - رسمي'),
            'casual_men' => Collection::firstWhere('title', 'رجالي - كاجوال'),
            'sports_men' => Collection::firstWhere('title', 'رجالي - رياضي'),
            'summer_women' => Collection::firstWhere('title', 'حريمي - صيفي'),
            'formal_women' => Collection::firstWhere('title', 'حريمي - رسمي'),
            'new_kids' => Collection::firstWhere('title', 'أطفال - جديد'),
            'casual_kids' => Collection::firstWhere('title', 'أطفال - كاجوال'),
            'accessories' => Collection::firstWhere('title', 'إكسسوارات'),
            'luxury_accessories' => Collection::firstWhere('title', 'إكسسوارات - فاخرة'),
            'special_offers' => Collection::firstWhere('title', 'عروض خاصة'),
        ];

        $products = [
            [
                'name' => 'قميص كتان فاخر',
                'category_id' => $categories['mens']->id,
                'subcategory_id' => $subs['mens_shirts']->id,
                'collection_id' => $collections['new_arrivals']->id,
                'tags' => ['linen', 'menswear', 'classic'],
                'price' => 850,
                'fabric' => 'كتان فائق الجودة',
                'notes' => 'قميص مريح وناعم مع لمسة فاخرة.',
                'cover_image' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=400',
                'status' => 'show',
            ],
            [
                'name' => 'قميص قطن رسمي',
                'category_id' => $categories['mens']->id,
                'subcategory_id' => $subs['mens_shirts']->id,
                'collection_id' => $collections['formal_men']->id,
                'tags' => ['cotton', 'formal', 'menswear'],
                'price' => 750,
                'fabric' => 'قطن 100%',
                'notes' => 'قميص رسمي مثالي للمناسبات المهنية.',
                'cover_image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400',
                'status' => 'show',
            ],
            [
                'name' => 'قميص بولو كلاسيك',
                'category_id' => $categories['mens']->id,
                'subcategory_id' => $subs['mens_shirts']->id,
                'collection_id' => $collections['casual_men']->id,
                'tags' => ['polo', 'casual', 'menswear'],
                'price' => 550,
                'fabric' => 'قطن مع نسبة إيلاستين',
                'notes' => 'قميص بولو مريح للاستخدام اليومي.',
                'cover_image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400',
                'status' => 'show',
            ],
            [
                'name' => 'بنطال تشينو كلاسيك',
                'category_id' => $categories['mens']->id,
                'subcategory_id' => $subs['mens_pants']->id,
                'collection_id' => $collections['casual_men']->id,
                'tags' => ['pants', 'menswear', 'casual'],
                'price' => 1200,
                'fabric' => 'قطن مع نسبة إيلاستين',
                'notes' => 'بنطال يومي مريح يناسب الاطلالات كاجوال.',
                'cover_image' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=400',
                'status' => 'show',
            ],
            [
                'name' => 'جاكيت عصري',
                'category_id' => $categories['mens']->id,
                'subcategory_id' => $subs['mens_jackets']->id,
                'collection_id' => $collections['new_arrivals']->id,
                'tags' => ['jacket', 'menswear', 'winter'],
                'price' => 1650,
                'fabric' => 'صوف مخلوط',
                'notes' => 'جاكيت أنيق للأجواء الباردة.',
                'cover_image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=400',
                'status' => 'show',
            ],
            [
                'name' => 'فستان سهرة حرير',
                'category_id' => $categories['womens']->id,
                'subcategory_id' => $subs['womens_dresses']->id,
                'collection_id' => $collections['formal_women']->id,
                'tags' => ['dress', 'silk', 'formal'],
                'price' => 2200,
                'fabric' => 'حرير طبيعي',
                'notes' => 'فستان أنيق للمناسبات الخاصة.',
                'cover_image' => 'https://images.unsplash.com/photo-1539008835270-386616781283?w=400',
                'status' => 'show',
            ],
            [
                'name' => 'حقيبة جلدية فاخرة',
                'category_id' => $categories['accessories']->id,
                'subcategory_id' => $subs['bags']->id,
                'collection_id' => $collections['luxury_accessories']->id,
                'tags' => ['bag', 'leather', 'luxury'],
                'price' => 2850,
                'fabric' => 'جلد فاخر مع معادن مطلية',
                'notes' => 'حقيبة يد أنيقة وعملية.',
                'cover_image' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=400',
                'status' => 'show',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
