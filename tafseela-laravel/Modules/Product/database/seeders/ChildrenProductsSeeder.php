<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Category;
use Modules\Product\Models\Collection;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductDetail;
use Modules\Product\Models\Subcategory;

class ChildrenProductsSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::firstOrCreate(['category' => 'أطفال']);

        $subcategories = [
            ['title' => 'أولاد', 'category_id' => $category->id],
            ['title' => 'بنات', 'category_id' => $category->id],
        ];

        foreach ($subcategories as $subData) {
            Subcategory::firstOrCreate($subData);
        }

        $collections = [
            ['title' => 'أطفال - جديد', 'cover_image' => null],
            ['title' => 'أطفال - كاجوال', 'cover_image' => null],
        ];

        foreach ($collections as $collectionData) {
            Collection::firstOrCreate(
                ['title' => $collectionData['title']],
                ['cover_image' => $collectionData['cover_image']]
            );
        }

        $subs = [
            'boys' => Subcategory::where(['title' => 'أولاد', 'category_id' => $category->id])->first(),
            'girls' => Subcategory::where(['title' => 'بنات', 'category_id' => $category->id])->first(),
        ];

        $cols = [
            'new_kids' => Collection::firstWhere('title', 'أطفال - جديد'),
            'casual_kids' => Collection::firstWhere('title', 'أطفال - كاجوال'),
        ];

        $products = [
            [
                'name' => 'تيشيرت أطفال برسومات',
                'category_id' => $category->id,
                'subcategory_id' => $subs['boys']->id,
                'collection_id' => $cols['new_kids']->id,
                'tags' => ['kids', 'tshirt', 'boys'],
                'price' => 450,
                'fabric' => 'قطن ناعم',
                'notes' => 'تيشيرت أطفال مريح برسومات مرحة.',
                'cover_image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400',
                'status' => 'show',
            ],
            [
                'name' => 'بنطال أطفال جينز',
                'category_id' => $category->id,
                'subcategory_id' => $subs['boys']->id,
                'collection_id' => $cols['casual_kids']->id,
                'tags' => ['kids', 'jeans', 'boys'],
                'price' => 620,
                'fabric' => 'دينم مرن',
                'notes' => 'بنطال جينز عملي ومتين للعب اليومي.',
                'cover_image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400',
                'status' => 'show',
            ],
            [
                'name' => 'فستان أطفال مطبوع',
                'category_id' => $category->id,
                'subcategory_id' => $subs['girls']->id,
                'collection_id' => $cols['new_kids']->id,
                'tags' => ['kids', 'dress', 'girls'],
                'price' => 540,
                'fabric' => 'قماش قطني خفيف',
                'notes' => 'فستان طفولي ملون بمطبوعات جذابة.',
                'cover_image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=400',
                'status' => 'show',
            ],
            [
                'name' => 'بلوزة أطفال بنقشة زهرية',
                'category_id' => $category->id,
                'subcategory_id' => $subs['girls']->id,
                'collection_id' => $cols['casual_kids']->id,
                'tags' => ['kids', 'top', 'girls'],
                'price' => 360,
                'fabric' => 'قطن مع لمسة إيلاستين',
                'notes' => 'بلوزة ناعمة بنقشة زهرية مناسبة للنزهات.',
                'cover_image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=400',
                'status' => 'show',
            ],
            [
                'name' => 'جاكيت أطفال دافئ',
                'category_id' => $category->id,
                'subcategory_id' => $subs['boys']->id,
                'collection_id' => $cols['casual_kids']->id,
                'tags' => ['kids', 'jacket', 'boys', 'winter'],
                'price' => 780,
                'fabric' => 'نايلون مقاوم للماء',
                'notes' => 'جاكيت دافئ للأطفال في الشتاء.',
                'cover_image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=400',
                'status' => 'show',
            ],
            [
                'name' => 'سروال أطفال رياضي',
                'category_id' => $category->id,
                'subcategory_id' => $subs['boys']->id,
                'collection_id' => $cols['new_kids']->id,
                'tags' => ['kids', 'shorts', 'boys', 'sports'],
                'price' => 420,
                'fabric' => 'قطن مع إيلاستين',
                'notes' => 'سروال رياضي مريح للعب.',
                'cover_image' => 'https://images.unsplash.com/photo-1591195853828-11db59a44f6b?w=400',
                'status' => 'show',
            ],
            [
                'name' => 'تنورة أطفال قصيرة',
                'category_id' => $category->id,
                'subcategory_id' => $subs['girls']->id,
                'collection_id' => $cols['casual_kids']->id,
                'tags' => ['kids', 'skirt', 'girls'],
                'price' => 380,
                'fabric' => 'قطن خفيف',
                'notes' => 'تنورة قصيرة لطيفة للفتيات.',
                'cover_image' => 'https://images.unsplash.com/photo-1583496661160-fb5886a6aaaa?w=400',
                'status' => 'show',
            ],
            [
                'name' => 'بلوزة أطفال مطرزة',
                'category_id' => $category->id,
                'subcategory_id' => $subs['girls']->id,
                'collection_id' => $cols['new_kids']->id,
                'tags' => ['kids', 'blouse', 'girls'],
                'price' => 490,
                'fabric' => 'قطن ناعم',
                'notes' => 'بلوزة مطرزة أنيقة للمناسبات.',
                'cover_image' => 'https://images.unsplash.com/photo-1551163943-3f6a855d1153?w=400',
                'status' => 'show',
            ],
        ];

        $createdProducts = [];

        foreach ($products as $productData) {
            $createdProducts[$productData['name']] = Product::updateOrCreate(
                ['name' => $productData['name']],
                $productData
            );
        }

        $details = [
            ['product_name' => 'تيشيرت أطفال برسومات', 'size' => '6', 'color' => '#0000FF', 'stock_qty' => 20, 'notes' => 'تيشيرت عملي للمدرسة.'],
            ['product_name' => 'تيشيرت أطفال برسومات', 'size' => '8', 'color' => '#008000', 'stock_qty' => 16, 'notes' => 'قماش مريح لليوم الكامل.'],
            ['product_name' => 'بنطال أطفال جينز', 'size' => '6', 'color' => '#000080', 'stock_qty' => 12, 'notes' => 'بنطال مرن ومتين للعب.'],
            ['product_name' => 'بنطال أطفال جينز', 'size' => '8', 'color' => '#000080', 'stock_qty' => 9, 'notes' => 'يتحمل غسل متكرر دون أن يتلف.'],
            ['product_name' => 'فستان أطفال مطبوع', 'size' => '4', 'color' => '#FFC0CB', 'stock_qty' => 14, 'notes' => 'فستان خفيف مناسب للأيام الدافئة.'],
            ['product_name' => 'فستان أطفال مطبوع', 'size' => '6', 'color' => '#FFFFFF', 'stock_qty' => 10, 'notes' => 'تصميم مفعم بالحيوية للطفلة.'],
            ['product_name' => 'بلوزة أطفال بنقشة زهرية', 'size' => '5', 'color' => '#FFC0CB', 'stock_qty' => 18, 'notes' => 'بلوزة خفيفة ومريحة للأنشطة اليومية.'],
            ['product_name' => 'بلوزة أطفال بنقشة زهرية', 'size' => '7', 'color' => '#FFFFFF', 'stock_qty' => 13, 'notes' => 'تصميم جذاب مع قماش مرن.'],
            ['product_name' => 'جاكيت أطفال دافئ', 'size' => '6', 'color' => '#0000FF', 'stock_qty' => 15, 'notes' => 'جاكيت دافئ مقاوم للماء.'],
            ['product_name' => 'جاكيت أطفال دافئ', 'size' => '8', 'color' => '#FF0000', 'stock_qty' => 12, 'notes' => 'مناسب للأجواء الباردة.'],
            ['product_name' => 'سروال أطفال رياضي', 'size' => '6', 'color' => '#808080', 'stock_qty' => 18, 'notes' => 'سروال مريح للرياضة.'],
            ['product_name' => 'سروال أطفال رياضي', 'size' => '8', 'color' => '#000000', 'stock_qty' => 14, 'notes' => 'خفيف ومرن.'],
            ['product_name' => 'تنورة أطفال قصيرة', 'size' => '4', 'color' => '#FFC0CB', 'stock_qty' => 16, 'notes' => 'تنورة لطيفة للفتيات.'],
            ['product_name' => 'تنورة أطفال قصيرة', 'size' => '6', 'color' => '#0000FF', 'stock_qty' => 13, 'notes' => 'تصميم مرح ومريح.'],
            ['product_name' => 'بلوزة أطفال مطرزة', 'size' => '5', 'color' => '#FFFFFF', 'stock_qty' => 11, 'notes' => 'بلوزة مطرزة أنيقة.'],
            ['product_name' => 'بلوزة أطفال مطرزة', 'size' => '7', 'color' => '#FFC0CB', 'stock_qty' => 9, 'notes' => 'للمناسبات الخاصة.'],
        ];

        $variantImages = [
            'https://images.unsplash.com/photo-1603252109303-2751441dd157?w=400',
            'https://images.unsplash.com/photo-1581655353564-df123a1eb820?w=400',
            'https://images.unsplash.com/photo-1593030761757-71fae45fa0e7?w=400',
            'https://images.unsplash.com/photo-1554568218-0f1715e72254?w=400',
            'https://images.unsplash.com/photo-1564257631407-4deb1f99d992?w=400',
            'https://images.unsplash.com/photo-1591369822096-6a6ef6c4e2cd?w=400',
            'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=400',
            'https://images.unsplash.com/photo-1503341455253-b2e723bb3dbb?w=400',
        ];

        $productDetailCount = [];

        foreach ($details as $detailData) {
            $product = $createdProducts[$detailData['product_name']] ?? Product::firstWhere('name', $detailData['product_name']);

            if (! $product) {
                continue;
            }

            $count = $productDetailCount[$product->id] ?? 0;
            $productDetailCount[$product->id] = $count + 1;

            $coverImage = $count === 0
                ? $product->cover_image
                : $variantImages[$product->id % count($variantImages)];

            ProductDetail::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'size' => $detailData['size'],
                    'color' => $detailData['color'],
                ],
                [
                    'stock_qty' => $detailData['stock_qty'],
                    'status' => 'show',
                    'notes' => $detailData['notes'],
                    'cover_image' => $coverImage,
                ]
            );
        }
    }
}
