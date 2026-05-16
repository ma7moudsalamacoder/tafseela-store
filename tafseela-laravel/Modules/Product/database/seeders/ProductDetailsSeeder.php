<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductDetail;

class ProductDetailsSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all()->keyBy('name');

        $details = [
            // Existing details
            ['product_name' => 'قميص كتان فاخر', 'size' => 'M', 'color' => '#FFFFFF', 'stock_qty' => 18, 'status' => 'show', 'notes' => 'قميص مناسب للصيف.'],
            ['product_name' => 'قميص كتان فاخر', 'size' => 'L', 'color' => '#000000', 'stock_qty' => 12, 'status' => 'show', 'notes' => 'تصميم أنيق ويتميز بالتهوية العالية.'],
            ['product_name' => 'قميص قطن رسمي', 'size' => 'M', 'color' => '#0000FF', 'stock_qty' => 15, 'status' => 'show', 'notes' => 'قميص رسمي كلاسيكي.'],
            ['product_name' => 'قميص قطن رسمي', 'size' => 'L', 'color' => '#FFFFFF', 'stock_qty' => 20, 'status' => 'show', 'notes' => 'مناسب للمناسبات الرسمية.'],
            ['product_name' => 'قميص بولو كلاسيك', 'size' => 'M', 'color' => '#008000', 'stock_qty' => 25, 'status' => 'show', 'notes' => 'قميص بولو مريح.'],
            ['product_name' => 'قميص بولو كلاسيك', 'size' => 'L', 'color' => '#FF0000', 'stock_qty' => 18, 'status' => 'show', 'notes' => 'تصميم كلاسيكي أنيق.'],
            ['product_name' => 'بنطال تشينو كلاسيك', 'size' => '32', 'color' => '#F5F5DC', 'stock_qty' => 14, 'status' => 'show', 'notes' => 'بنطال عملي يومي.'],
            ['product_name' => 'بنطال تشينو كلاسيك', 'size' => '34', 'color' => '#000080', 'stock_qty' => 10, 'status' => 'show', 'notes' => 'خامة مريحة مع مرونة خفيفة.'],
            ['product_name' => 'بنطال جينز رسمي', 'size' => '32', 'color' => '#000080', 'stock_qty' => 12, 'status' => 'show', 'notes' => 'بنطال جينز أنيق.'],
            ['product_name' => 'بنطال جينز رسمي', 'size' => '34', 'color' => '#000000', 'stock_qty' => 8, 'status' => 'show', 'notes' => 'مناسب للمناسبات الرسمية.'],
            ['product_name' => 'جاكيت عصري', 'size' => 'M', 'color' => '#000080', 'stock_qty' => 5, 'status' => 'show', 'notes' => 'جاكيت أنيق للخروج.'],
            ['product_name' => 'جاكيت عصري', 'size' => 'L', 'color' => '#808080', 'stock_qty' => 8, 'status' => 'show', 'notes' => 'مناسب للأجواء الباردة.'],
            ['product_name' => 'جاكيت رياضي', 'size' => 'M', 'color' => '#000000', 'stock_qty' => 15, 'status' => 'show', 'notes' => 'جاكيت رياضي خفيف.'],
            ['product_name' => 'جاكيت رياضي', 'size' => 'L', 'color' => '#0000FF', 'stock_qty' => 12, 'status' => 'show', 'notes' => 'مقاوم للماء.'],
            ['product_name' => 'تيشيرت قطن أساسي', 'size' => 'M', 'color' => '#FFFFFF', 'stock_qty' => 30, 'status' => 'show', 'notes' => 'تيشيرت أساسي مريح.'],
            ['product_name' => 'تيشيرت قطن أساسي', 'size' => 'L', 'color' => '#000000', 'stock_qty' => 25, 'status' => 'show', 'notes' => 'مناسب للاستخدام اليومي.'],
            ['product_name' => 'سروال قصير رياضي', 'size' => 'M', 'color' => '#808080', 'stock_qty' => 20, 'status' => 'show', 'notes' => 'سروال قصير مريح.'],
            ['product_name' => 'سروال قصير رياضي', 'size' => 'L', 'color' => '#000000', 'stock_qty' => 18, 'status' => 'show', 'notes' => 'للأنشطة الرياضية.'],
            ['product_name' => 'فستان سهرة حرير', 'size' => 'S', 'color' => '#FF0000', 'stock_qty' => 9, 'status' => 'show', 'notes' => 'فستان سهرة بمظهر لامع.'],
            ['product_name' => 'فستان سهرة حرير', 'size' => 'M', 'color' => '#FFD700', 'stock_qty' => 6, 'status' => 'show', 'notes' => 'يتطلب تنظيفاً جافاً للحفاظ على قماشه.'],
            ['product_name' => 'فستان صيفي خفيف', 'size' => 'S', 'color' => '#0000FF', 'stock_qty' => 15, 'status' => 'show', 'notes' => 'فستان صيفي خفيف.'],
            ['product_name' => 'فستان صيفي خفيف', 'size' => 'M', 'color' => '#FFC0CB', 'stock_qty' => 12, 'status' => 'show', 'notes' => 'مناسب للطقس الحار.'],
            ['product_name' => 'بلوزة حرير ناعمة', 'size' => 'S', 'color' => '#FFFFFF', 'stock_qty' => 10, 'status' => 'show', 'notes' => 'بلوزة حرير ناعمة.'],
            ['product_name' => 'بلوزة حرير ناعمة', 'size' => 'M', 'color' => '#000000', 'stock_qty' => 8, 'status' => 'show', 'notes' => 'مثالية للمناسبات الرسمية.'],
            ['product_name' => 'تنورة قصيرة عصرية', 'size' => 'S', 'color' => '#000000', 'stock_qty' => 14, 'status' => 'show', 'notes' => 'تنورة قصيرة عصرية.'],
            ['product_name' => 'تنورة قصيرة عصرية', 'size' => 'M', 'color' => '#A52A2A', 'stock_qty' => 11, 'status' => 'show', 'notes' => 'للاطلالات الكاجوال.'],
            ['product_name' => 'بنطال نسائي أنيق', 'size' => 'S', 'color' => '#000000', 'stock_qty' => 13, 'status' => 'show', 'notes' => 'بنطال نسائي أنيق.'],
            ['product_name' => 'بنطال نسائي أنيق', 'size' => 'M', 'color' => '#000080', 'stock_qty' => 10, 'status' => 'show', 'notes' => 'للمناسبات الرسمية.'],
            ['product_name' => 'حذاء جلد طبيعي', 'size' => '42', 'color' => '#000000', 'stock_qty' => 20, 'status' => 'show', 'notes' => 'حذاء رسمي مريح.'],
            ['product_name' => 'حذاء جلد طبيعي', 'size' => '43', 'color' => '#A52A2A', 'stock_qty' => 15, 'status' => 'show', 'notes' => 'متين مع لمسة جلد طبيعية.'],
            ['product_name' => 'حقيبة جلدية فاخرة', 'size' => 'One Size', 'color' => '#000000', 'stock_qty' => 7, 'status' => 'show', 'notes' => 'حقيبة جلدية فاخرة.'],
            ['product_name' => 'حقيبة جلدية فاخرة', 'size' => 'One Size', 'color' => '#A52A2A', 'stock_qty' => 5, 'status' => 'show', 'notes' => 'تصميم أنيق ومتين.'],
            ['product_name' => 'عقد ذهبي أنيق', 'size' => 'One Size', 'color' => '#FFD700', 'stock_qty' => 3, 'status' => 'show', 'notes' => 'عقد ذهبي أنيق.'],
            ['product_name' => 'نظارات شمسية عصرية', 'size' => 'One Size', 'color' => '#000000', 'stock_qty' => 12, 'status' => 'show', 'notes' => 'نظارات شمسية عصرية.'],
            ['product_name' => 'نظارات شمسية عصرية', 'size' => 'One Size', 'color' => '#A52A2A', 'stock_qty' => 10, 'status' => 'show', 'notes' => 'تحمي من الأشعة فوق البنفسجية.'],
            ['product_name' => 'تيشيرت أطفال برسومات', 'size' => '6', 'color' => '#0000FF', 'stock_qty' => 20, 'status' => 'show', 'notes' => 'تيشيرت عملي للمدرسة.'],
            ['product_name' => 'تيشيرت أطفال برسومات', 'size' => '8', 'color' => '#008000', 'stock_qty' => 16, 'status' => 'show', 'notes' => 'قماش مريح لليوم الكامل.'],
            ['product_name' => 'بنطال أطفال جينز', 'size' => '6', 'color' => '#000080', 'stock_qty' => 12, 'status' => 'show', 'notes' => 'بنطال مرن ومتين للعب.'],
            ['product_name' => 'بنطال أطفال جينز', 'size' => '8', 'color' => '#000080', 'stock_qty' => 9, 'status' => 'show', 'notes' => 'يتحمل غسل متكرر دون أن يتلف.'],
            ['product_name' => 'فستان أطفال مطبوع', 'size' => '4', 'color' => '#FFC0CB', 'stock_qty' => 14, 'status' => 'show', 'notes' => 'فستان خفيف مناسب للأيام الدافئة.'],
            ['product_name' => 'فستان أطفال مطبوع', 'size' => '6', 'color' => '#FFFFFF', 'stock_qty' => 10, 'status' => 'show', 'notes' => 'تصميم مفعم بالحيوية للطفلة.'],
            ['product_name' => 'بلوزة أطفال بنقشة زهرية', 'size' => '5', 'color' => '#FFC0CB', 'stock_qty' => 18, 'status' => 'show', 'notes' => 'بلوزة خفيفة ومريحة للأنشطة اليومية.'],
            ['product_name' => 'بلوزة أطفال بنقشة زهرية', 'size' => '7', 'color' => '#FFFFFF', 'stock_qty' => 13, 'status' => 'show', 'notes' => 'تصميم جذاب مع قماش مرن.'],
            ['product_name' => 'بدلة رضع مريحة', 'size' => '3-6 months', 'color' => '#FFFF00', 'stock_qty' => 25, 'status' => 'show', 'notes' => 'بدلة رضع مريحة وآمنة.'],
            ['product_name' => 'بدلة رضع مريحة', 'size' => '6-12 months', 'color' => '#0000FF', 'stock_qty' => 20, 'status' => 'show', 'notes' => 'قطن عضوي ناعم.'],
            ['product_name' => 'جاكيت شتوي مخفض', 'size' => 'M', 'color' => '#000000', 'stock_qty' => 10, 'status' => 'show', 'notes' => 'جاكيت شتوي بعرض خاص.'],
            ['product_name' => 'جاكيت شتوي مخفض', 'size' => 'L', 'color' => '#808080', 'stock_qty' => 8, 'status' => 'show', 'notes' => 'دافئ ومريح.'],
        ];

        $variantImages = [
            'https://images.unsplash.com/photo-1603252109303-2751441dd157?w=400',
            'https://images.unsplash.com/photo-1581655353564-df123a1eb820?w=400',
            'https://images.unsplash.com/photo-1593030761757-71fae45fa0e7?w=400',
            'https://images.unsplash.com/photo-1554568218-0f1715e72254?w=400',
            'https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=400',
            'https://images.unsplash.com/photo-1564257631407-4deb1f99d992?w=400',
            'https://images.unsplash.com/photo-1591369822096-6a6ef6c4e2cd?w=400',
            'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=400',
            'https://images.unsplash.com/photo-1503341455253-b2e723bb3dbb?w=400',
            'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=400',
            'https://images.unsplash.com/photo-1556306535-0f09a537f0a3?w=400',
            'https://images.unsplash.com/photo-1593030761757-71fae45fa0e7?w=400',
            'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=400',
            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400',
            'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400',
            'https://images.unsplash.com/photo-1542272604-787c3835535d?w=400',
        ];

        $productDetailCount = [];

        foreach ($details as $detail) {
            $product = $products[$detail['product_name']] ?? null;

            if (! $product) {
                continue;
            }

            $count = $productDetailCount[$product->id] ?? 0;
            $productDetailCount[$product->id] = $count + 1;

            $coverImage = $count === 0
                ? $product->cover_image
                : $variantImages[$product->id % count($variantImages)];

            ProductDetail::create([
                'product_id' => $product->id,
                'size' => $detail['size'],
                'color' => $detail['color'],
                'stock_qty' => $detail['stock_qty'],
                'status' => $detail['status'],
                'notes' => $detail['notes'],
                'cover_image' => $coverImage,
            ]);
        }
    }
}
