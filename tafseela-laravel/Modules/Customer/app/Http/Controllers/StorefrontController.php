<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\View\View;
use Modules\Product\Models\Category;
use Modules\Product\Models\Product;

class StorefrontController extends Controller
{
    private ?array $products = null;

    public function products(): View
    {
        return view('customer::products.index', [
            'products' => $this->productsData(),
            'categories' => $this->categories(),
            'sizeOptions' => ['S', 'M', 'L', 'XL', 'XXL'],
            'colorOptions' => ['#1A1A1A', '#FFFFFF', '#1E3A8A', '#7D5A39', '#991B1B'],
        ]);
    }

    public function section(string $slug): View
    {
        $section = $this->sections()[$slug] ?? $this->defaultSection($slug);
        $products = array_values(array_filter(
            $this->productsData(),
            fn (array $product): bool => $product['section_slug'] === $slug
        ));

        if ($products === []) {
            $products = array_slice($this->productsData(), 0, 3);
        }

        return view('customer::sections.show', [
            'section' => $section,
            'products' => $products,
            'categories' => $this->categories(),
            'sizeOptions' => ['S', 'M', 'L', 'XL'],
            'colorOptions' => ['أسود', 'أبيض', 'كحلي', 'بني', 'أحمر'],
        ]);
    }

    public function product(string $slug): View
    {
        $product = $this->findProduct($slug);

        return view('customer::products.show', [
            'product' => $product,
            'relatedProducts' => array_values(array_filter(
                $this->productsData(),
                fn (array $item): bool => $item['slug'] !== $slug
            )),
        ]);
    }

    public function checkout(): View
    {
        return view('customer::checkout', [
            'order' => $this->orderData(),
        ]);
    }

    public function orderCompleted(): View
    {
        return view('customer::orders.completed', [
            'order' => $this->orderData(),
            'recommendedProducts' => array_slice($this->productsData(), 0, 4),
        ]);
    }

    public function orderTracking(): View
    {
        return view('customer::orders.tracking', [
            'order' => $this->orderData(),
            'recommendedProducts' => array_slice($this->productsData(), 1, 4),
        ]);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function productsData(): array
    {
        if ($this->products !== null) {
            return $this->products;
        }

        $this->products = Product::query()
            ->with(['category', 'collection', 'details'])
            ->where('status', 'show')
            ->get()
            ->map(fn (Product $product): array => $this->mapProduct($product))
            ->all();

        return $this->products;
    }

    private function mapProduct(Product $product): array
    {
        $category = $product->category;
        $collection = $product->collection;
        $details = $product->details;

        $sizes = $details->pluck('size')->filter()->unique()->values()->all();
        $colors = $details->pluck('color')->filter()->unique()->values()->all();

        $slug = $this->slugString($product->name) ?: (string) $product->id;

        return [
            'id' => $product->id,
            'slug' => $slug,
            'name' => $product->name,
            'subtitle' => $collection?->title ?? $category?->category ?? 'منتجات',
            'section_slug' => $category ? ($category->subcategory ? $this->slugString($category->subcategory) : $this->slugString($category->category)) : 'products',
            'section_name' => $category?->subcategory ?? $category?->category ?? 'منتجات',
            'price' => $product->price,
            'formatted_price' => number_format($product->price, 0, '.', ',') . ' جنيه',
            'old_price' => null,
            'formatted_old_price' => null,
            'badge' => $collection && $collection->title === 'وصلنا حديثاً' ? 'وصلنا حديثاً' : null,
            'description' => trim($product->notes ?: $product->fabric ?: 'تفاصيل المنتج غير متوفرة.'),
            'short_description' => trim($product->fabric ?: $product->notes ?: 'اكتشف هذا المنتج المميز.'),
            'main_image' => $product->image ?: asset('images/product-placeholder.png'),
            'gallery' => array_fill(0, 4, $product->image ?: asset('images/product-placeholder.png')),
            'colors' => $colors ?: ['أسود', 'أبيض', 'كحلي'],
            'sizes' => $sizes ?: ['S', 'M', 'L', 'XL'],
            'selected_size' => $sizes[0] ?? 'M',
            'details' => [
                'الوصف' => $product->notes ?: 'تفاصيل المنتج غير متوفرة.',
                'الخامات والعناية' => $product->fabric
                    ? sprintf('الخامة: %s. ينصح باتباع تعليمات العناية الملصقة على المنتج.', $product->fabric)
                    : 'تفاصيل الخامة غير متاحة.',
            ],
        ];
    }

    /**
     * @return string
     */
    private function slugString(string $value): string
    {
        $slug = preg_replace('/[^\p{L}\p{N}\s-]+/u', '', $value);
        $slug = preg_replace('/[\s]+/u', '-', trim($slug));

        return mb_strtolower($slug, 'UTF-8');
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private function sections(): array
    {
        return [
            'mens-shirts' => [
                'slug' => 'mens-shirts',
                'name' => 'قمصان رجالي',
                'parent' => 'أزياء',
                'description' => 'تشكيلة مختارة من القمصان الرجالي بين الرسمي والكاجوال بخامات فاخرة ومقاسات متعددة.',
                'product_count' => 85,
            ],
            'womens-dresses' => [
                'slug' => 'womens-dresses',
                'name' => 'فساتين نسائي',
                'parent' => 'أزياء',
                'description' => 'فساتين نسائية بتفاصيل أنثوية ولمسات عصرية تناسب المناسبات المختلفة.',
                'product_count' => 42,
            ],
            'mens-jackets' => [
                'slug' => 'mens-jackets',
                'name' => 'جواكت رجالي',
                'parent' => 'أزياء',
                'description' => 'جواكت وبلايزر رجالي تجمع بين الأناقة والعملية للمواسم الباردة.',
                'product_count' => 24,
            ],
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function categories(): array
    {
        return Category::query()
            ->withCount(['products' => fn ($query) => $query->where('status', 'show')])
            ->get()
            ->map(fn (Category $category): array => [
                'name' => $category->subcategory ?: $category->category,
                'count' => $category->products_count,
            ])
            ->values()
            ->all();
    }

    /**
     * @return array<string, mixed>
     */
    private function orderData(): array
    {
        return [
            'number' => 'TF-98234',
            'placed_at' => '20 مايو 2024',
            'expected_delivery' => 'الأربعاء، 24 مايو - السبت، 27 مايو',
            'shipping_address' => [
                'name' => 'أحمد محمد',
                'line1' => '24 شارع التسعين الشمالي، التجمع الخامس',
                'city' => 'القاهرة، مصر',
            ],
            'tracking' => [
                'carrier' => 'أرامكس - Aramex',
                'number' => 'AX-5928114092',
                'status' => 'في الطريق إليك',
            ],
            'items' => [
                [
                    'name' => 'قميص كتان فاخر - أزرق داكن',
                    'meta' => 'مقاس: L | الكمية: 1',
                    'category' => 'رجالي - أزرق فاتح / XL',
                    'price' => '850 جنيه',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAa8rxsCtnHO1uoqPKohyj3olgrRNYd84CD7ibbTxlOhJunn23RMdUvhV50rilc6g5xsGQ_Bz3Y6_Xi3llenb_loo06rLbJj2A5MY-DoJt46VO0LHC-q4_C_TuacMR1u3F4JMj1Ljr3TR_Js_TN_DGjG6a96fJulUh_UttCtpU5wRgwu7HoF0JwqHBOu_Qz_pKne5ROiSCvA5oWyansb_9tY7WE5Mz3MOeEqJBIlamFRHh5OYXaonC9MQawVhOYhPZoq8Au59PQYaLn',
                    'quantity' => 1,
                ],
                [
                    'name' => 'بنطال تشينو كلاسيك',
                    'meta' => 'مقاس: 32 | الكمية: 1',
                    'category' => 'رجالي - بيج / 32',
                    'price' => '1,200 جنيه',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD55sDnuTNCU7sBX1jr1StVjbWmYFeqZK4Gy_tpA6izp9D-hK7bZkpmRo2dZOfQP4KUjqpRKi86MyDd0QDfy__R8OTaSxS68fA5-b4xtYTrdutWDPR6bZd8wYTbfVUCphyByZDz-Yl8MPS2HTrOes1u1KdzS8s8D_vR6nKfySirpmhbBVYMuxKNadWMwau8YSMjRKphq53QPJM6UIRQCB20U0jc1Df1gdbsol42-LzV68izutNhL6PJza4Gw7gj4yAqMsIRyxw_z2I0',
                    'quantity' => 1,
                ],
            ],
            'summary' => [
                'subtotal' => '2,050 جنيه',
                'shipping' => 'مجاني',
                'discount' => '-145 جنيه',
                'total' => '1,905 جنيه',
            ],
            'timeline' => [
                [
                    'title' => 'تم الشحن من المستودع',
                    'location' => 'القاهرة، مدينة نصر - مركز التوزيع الرئيسي',
                    'date' => '22 مايو 2024',
                    'time' => '09:45 AM',
                    'active' => true,
                ],
                [
                    'title' => 'تم تجهيز الطلب للتغليف',
                    'location' => 'تم التحقق من جودة المنتجات وتغليفها',
                    'date' => '21 مايو 2024',
                    'time' => '02:30 PM',
                    'active' => false,
                ],
                [
                    'title' => 'تم تأكيد الطلب بنجاح',
                    'location' => 'بدء معالجة الطلب في نظامنا',
                    'date' => '20 مايو 2024',
                    'time' => '11:15 AM',
                    'active' => false,
                ],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function findProduct(string $slug): array
    {
        foreach ($this->productsData() as $product) {
            if ($product['slug'] === $slug) {
                return $product;
            }
        }

        return $this->productsData()[0];
    }

    /**
     * @return array<string, mixed>
     */
    private function defaultSection(string $slug): array
    {
        return [
            'slug' => $slug,
            'name' => 'القسم',
            'parent' => 'أزياء',
            'description' => 'مجموعة متنوعة من منتجات تفصيلة المختارة بعناية.',
            'product_count' => 24,
        ];
    }
}
