<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\View\View;

class StorefrontController extends Controller
{
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
        return [
            [
                'id' => 1,
                'slug' => 'premium-linen-shirt',
                'name' => 'قميص كتان فاخر',
                'subtitle' => 'رجالي - كلاسيك',
                'section_slug' => 'mens-shirts',
                'section_name' => 'قمصان رجالي',
                'price' => 850,
                'formatted_price' => '850 جنيه',
                'old_price' => 1100,
                'formatted_old_price' => '1,100 جنيه',
                'badge' => 'وصلنا حديثاً',
                'description' => 'صمم هذا القميص من أرقى أنواع الكتان الطبيعي ليوفر لك الراحة والأناقة في آن واحد. يتميز بقصة عصرية تناسب جميع المناسبات الرسمية والكاجوال.',
                'short_description' => 'قميص كتان أنيق بقصة عصرية ولمسة فاخرة تناسب الإطلالات اليومية والرسمية.',
                'main_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAa8rxsCtnHO1uoqPKohyj3olgrRNYd84CD7ibbTxlOhJunn23RMdUvhV50rilc6g5xsGQ_Bz3Y6_Xi3llenb_loo06rLbJj2A5MY-DoJt46VO0LHC-q4_C_TuacMR1u3F4JMj1Ljr3TR_Js_TN_DGjG6a96fJulUh_UttCtpU5wRgwu7HoF0JwqHBOu_Qz_pKne5ROiSCvA5oWyansb_9tY7WE5Mz3MOeEqJBIlamFRHh5OYXaonC9MQawVhOYhPZoq8Au59PQYaLn',
                'gallery' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuAa8rxsCtnHO1uoqPKohyj3olgrRNYd84CD7ibbTxlOhJunn23RMdUvhV50rilc6g5xsGQ_Bz3Y6_Xi3llenb_loo06rLbJj2A5MY-DoJt46VO0LHC-q4_C_TuacMR1u3F4JMj1Ljr3TR_Js_TN_DGjG6a96fJulUh_UttCtpU5wRgwu7HoF0JwqHBOu_Qz_pKne5ROiSCvA5oWyansb_9tY7WE5Mz3MOeEqJBIlamFRHh5OYXaonC9MQawVhOYhPZoq8Au59PQYaLn',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuDfMNJWS58aYPNNEez7zZBK5oYciY9gRf1GmsCiGl5SzDQjlijSF7npj2Mt4NvlkEPwpwhWpFmI7xkaz5-A16AUn3QOJq0vdNIyeOmDH8gyNS5jxRDEjW4aYPqGjFzkGzpH_TVCvOzCXirQkdZh9p42PP65T5aKazbGhn-0H8vn4zOGs6qOHiF7ASAXUd22n5J9ViCrJgx0ASgEWABTEchYdsy1T8PuXZjOWvjQJcpXXRLC7J7EyBtUkgOKd7YQ_qoisaPjpRaZMtSu',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuAbi3E7Kulf-O39skm-_q21SAHf1y-hZ4ToIZmrNSJz5N7tKArej1WXHzgD2l1Jvtm7wor_gDh9NC2j0ZAMXdV1bCjcvYAqXP_xWrT6PSJYaKk9-1PdFQopPgmBmBFgWDA5_sJ3Vnxzp9IkrlliKv5tQZjFVT3j-_BoV5Y9Ij4sr1ctB3EuNxssOGOTkdmFQ8tWUJ1V3wJAXvqDNNnN-M_9wCPr9ClSqkeODujbxIdxwFE12bb2qCRHl3mp8xOFHnrxg00RkrqoykTB',
                ],
                'colors' => ['أسود', 'أبيض', 'بني', 'كحلي'],
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
                'selected_size' => 'M',
                'details' => [
                    'الوصف' => 'قماش كتان طبيعي بتهوية عالية ولمسة ناعمة، مع ياقة كلاسيكية وأزرار مخفية بإتقان.',
                    'الخامات والعناية' => '100% كتان. يغسل بماء بارد ويكوى على درجة منخفضة للحفاظ على الملمس.',
                ],
            ],
            [
                'id' => 2,
                'slug' => 'silk-evening-dress',
                'name' => 'فستان سهرة حرير',
                'subtitle' => 'حريمي - مناسبات',
                'section_slug' => 'womens-dresses',
                'section_name' => 'فساتين نسائي',
                'price' => 2200,
                'formatted_price' => '2,200 جنيه',
                'old_price' => 2600,
                'formatted_old_price' => '2,600 جنيه',
                'badge' => 'خصم 15%',
                'description' => 'فستان سهرة فاخر بقصة انسيابية وتفاصيل حريرية ناعمة يمنحك حضوراً لافتاً في المناسبات.',
                'short_description' => 'فستان سهرة حريري بتفاصيل أنيقة ولمعان هادئ للمناسبات الخاصة.',
                'main_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD55sDnuTNCU7sBX1jr1StVjbWmYFeqZK4Gy_tpA6izp9D-hK7bZkpmRo2dZOfQP4KUjqpRKi86MyDd0QDfy__R8OTaSxS68fA5-b4xtYTrdutWDPR6bZd8wYTbfVUCphyByZDz-Yl8MPS2HTrOes1u1KdzS8s8D_vR6nKfySirpmhbBVYMuxKNadWMwau8YSMjRKphq53QPJM6UIRQCB20U0jc1Df1gdbsol42-LzV68izutNhL6PJza4Gw7gj4yAqMsIRyxw_z2I0',
                'gallery' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuD55sDnuTNCU7sBX1jr1StVjbWmYFeqZK4Gy_tpA6izp9D-hK7bZkpmRo2dZOfQP4KUjqpRKi86MyDd0QDfy__R8OTaSxS68fA5-b4xtYTrdutWDPR6bZd8wYTbfVUCphyByZDz-Yl8MPS2HTrOes1u1KdzS8s8D_vR6nKfySirpmhbBVYMuxKNadWMwau8YSMjRKphq53QPJM6UIRQCB20U0jc1Df1gdbsol42-LzV68izutNhL6PJza4Gw7gj4yAqMsIRyxw_z2I0',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuA1e3t8dR8xZ2WI1MVX0Gqk8raZ9GUv7YaPyACYE4NdFCZyv_jRej1HZ5hgwDvEGUFNjpp2Ggb2i-KJJvdSIVIPB4D7hndDuZjPmWrs5yXhgpJoQ5F3CwhVdwoxRJfJV9ejc9XdgoYJUOXakvpAYgx_BQwT2GVe40SawcCY_aWVkn8K9Yr8WY5S8935KjXxxCLo06IcJ1wmOMevC9pQSreWx96ISzPU_PDNuRGJLtfxsKR_jK_CwTKOgO7wN2URxaWF29Qq02zL6uoB',
                ],
                'colors' => ['أحمر', 'أسود', 'ذهبي'],
                'sizes' => ['S', 'M', 'L', 'XL'],
                'selected_size' => 'L',
                'details' => [
                    'الوصف' => 'تصميم انسيابي مع خصر محدد وتفاصيل لامعة خفيفة لمظهر راقٍ.',
                    'الخامات والعناية' => 'حرير صناعي فاخر، ينظف تنظيفاً جافاً للحفاظ على البنية.',
                ],
            ],
            [
                'id' => 3,
                'slug' => 'modern-jacket',
                'name' => 'جاكيت عصري',
                'subtitle' => 'رجالي - شتوي',
                'section_slug' => 'mens-jackets',
                'section_name' => 'جواكت رجالي',
                'price' => 1650,
                'formatted_price' => '1,650 جنيه',
                'old_price' => null,
                'formatted_old_price' => null,
                'badge' => 'إصدار محدود',
                'description' => 'جاكيت عملي بلمسة عصرية وتفصيلات دقيقة يناسب الإطلالات اليومية الأنيقة.',
                'short_description' => 'جاكيت شتوي أنيق بقصة معاصرة وتفاصيل عملية.',
                'main_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAbi3E7Kulf-O39skm-_q21SAHf1y-hZ4ToIZmrNSJz5N7tKArej1WXHzgD2l1Jvtm7wor_gDh9NC2j0ZAMXdV1bCjcvYAqXP_xWrT6PSJYaKk9-1PdFQopPgmBmBFgWDA5_sJ3Vnxzp9IkrlliKv5tQZjFVT3j-_BoV5Y9Ij4sr1ctB3EuNxssOGOTkdmFQ8tWUJ1V3wJAXvqDNNnN-M_9wCPr9ClSqkeODujbxIdxwFE12bb2qCRHl3mp8xOFHnrxg00RkrqoykTB',
                'gallery' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuAbi3E7Kulf-O39skm-_q21SAHf1y-hZ4ToIZmrNSJz5N7tKArej1WXHzgD2l1Jvtm7wor_gDh9NC2j0ZAMXdV1bCjcvYAqXP_xWrT6PSJYaKk9-1PdFQopPgmBmBFgWDA5_sJ3Vnxzp9IkrlliKv5tQZjFVT3j-_BoV5Y9Ij4sr1ctB3EuNxssOGOTkdmFQ8tWUJ1V3wJAXvqDNNnN-M_9wCPr9ClSqkeODujbxIdxwFE12bb2qCRHl3mp8xOFHnrxg00RkrqoykTB',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuAtKicfpnDGxV6OZ2AcKbavKPy2wiKTHJpXSR_qEVlqnyuzIWeOETtGbC1_xTCE3wiEs37Je1VvyoWrDgJlz4-W0sOonxdwLSRtNxXrYspmmROYfEJ9Bgx31eWI7Aha_atd1OG0Q6EAEIuvh7oHir9DLMvuPUNLiVe2XwNwWYuAOtONslDp2u_F7V9pMFNeviQfyvM92F3CZlvlpUvctZJLIOB_tmP_EKmLrmB26IrTo3Lm4KX8ty7bDv3v09A3LtqGyo_7BJUoin53',
                ],
                'colors' => ['كحلي', 'رمادي', 'أسود'],
                'sizes' => ['M', 'L', 'XL'],
                'selected_size' => 'L',
                'details' => [
                    'الوصف' => 'مناسب للأجواء الباردة مع بطانة خفيفة وجيوب عملية.',
                    'الخامات والعناية' => 'خليط صوف وبوليستر، يغسل يدوياً أو تنظيف جاف.',
                ],
            ],
            [
                'id' => 4,
                'slug' => 'classic-chino-pants',
                'name' => 'بنطال تشينو كلاسيك',
                'subtitle' => 'رجالي - كاجوال',
                'section_slug' => 'mens-pants',
                'section_name' => 'بناطيل رجالي',
                'price' => 1200,
                'formatted_price' => '1,200 جنيه',
                'old_price' => null,
                'formatted_old_price' => null,
                'badge' => null,
                'description' => 'بنطال تشينو بتفصيلة متوازنة يدمج الراحة مع الطابع العملي الأنيق.',
                'short_description' => 'بنطال تشينو مرن للاستخدام اليومي بإطلالة مرتبة.',
                'main_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDfMNJWS58aYPNNEez7zZBK5oYciY9gRf1GmsCiGl5SzDQjlijSF7npj2Mt4NvlkEPwpwhWpFmI7xkaz5-A16AUn3QOJq0vdNIyeOmDH8gyNS5jxRDEjW4aYPqGjFzkGzpH_TVCvOzCXirQkdZh9p42PP65T5aKazbGhn-0H8vn4zOGs6qOHiF7ASAXUd22n5J9ViCrJgx0ASgEWABTEchYdsy1T8PuXZjOWvjQJcpXXRLC7J7EyBtUkgOKd7YQ_qoisaPjpRaZMtSu',
                'gallery' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuDfMNJWS58aYPNNEez7zZBK5oYciY9gRf1GmsCiGl5SzDQjlijSF7npj2Mt4NvlkEPwpwhWpFmI7xkaz5-A16AUn3QOJq0vdNIyeOmDH8gyNS5jxRDEjW4aYPqGjFzkGzpH_TVCvOzCXirQkdZh9p42PP65T5aKazbGhn-0H8vn4zOGs6qOHiF7ASAXUd22n5J9ViCrJgx0ASgEWABTEchYdsy1T8PuXZjOWvjQJcpXXRLC7J7EyBtUkgOKd7YQ_qoisaPjpRaZMtSu',
                ],
                'colors' => ['رمادي', 'بيج', 'كحلي'],
                'sizes' => ['30', '32', '34', '36'],
                'selected_size' => '32',
                'details' => [
                    'الوصف' => 'بنطال يومي بقصة مستقيمة وخامة متينة مع مرونة خفيفة.',
                    'الخامات والعناية' => 'قطن مع نسبة إيلاستين بسيطة، يغسل في الغسالة على دورة لطيفة.',
                ],
            ],
            [
                'id' => 5,
                'slug' => 'soft-knit-cardigan',
                'name' => 'سترة صوفية ناعمة',
                'subtitle' => 'حريمي - شتوي',
                'section_slug' => 'womens-knitwear',
                'section_name' => 'تريكو نسائي',
                'price' => 1450,
                'formatted_price' => '1,450 جنيه',
                'old_price' => null,
                'formatted_old_price' => null,
                'badge' => 'الأكثر مبيعاً',
                'description' => 'سترة صوفية ناعمة بطبقات دافئة وتفصيلات أنيقة تناسب الإطلالات الشتوية اليومية.',
                'short_description' => 'سترة دافئة بملمس ناعم وتفاصيل مريحة.',
                'main_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAtKicfpnDGxV6OZ2AcKbavKPy2wiKTHJpXSR_qEVlqnyuzIWeOETtGbC1_xTCE3wiEs37Je1VvyoWrDgJlz4-W0sOonxdwLSRtNxXrYspmmROYfEJ9Bgx31eWI7Aha_atd1OG0Q6EAEIuvh7oHir9DLMvuPUNLiVe2XwNwWYuAOtONslDp2u_F7V9pMFNeviQfyvM92F3CZlvlpUvctZJLIOB_tmP_EKmLrmB26IrTo3Lm4KX8ty7bDv3v09A3LtqGyo_7BJUoin53',
                'gallery' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuAtKicfpnDGxV6OZ2AcKbavKPy2wiKTHJpXSR_qEVlqnyuzIWeOETtGbC1_xTCE3wiEs37Je1VvyoWrDgJlz4-W0sOonxdwLSRtNxXrYspmmROYfEJ9Bgx31eWI7Aha_atd1OG0Q6EAEIuvh7oHir9DLMvuPUNLiVe2XwNwWYuAOtONslDp2u_F7V9pMFNeviQfyvM92F3CZlvlpUvctZJLIOB_tmP_EKmLrmB26IrTo3Lm4KX8ty7bDv3v09A3LtqGyo_7BJUoin53',
                ],
                'colors' => ['عاجي', 'بني', 'زيتي'],
                'sizes' => ['S', 'M', 'L'],
                'selected_size' => 'M',
                'details' => [
                    'الوصف' => 'قطعة شتوية ناعمة مثالية للتنسيق مع البنطال أو الفساتين الخفيفة.',
                    'الخامات والعناية' => 'خليط صوف وأكريليك، يفضل الغسيل اليدوي.',
                ],
            ],
            [
                'id' => 6,
                'slug' => 'natural-leather-shoes',
                'name' => 'حذاء جلد طبيعي',
                'subtitle' => 'إكسسوارات - رسمي',
                'section_slug' => 'accessories',
                'section_name' => 'إكسسوارات',
                'price' => 1950,
                'formatted_price' => '1,950 جنيه',
                'old_price' => null,
                'formatted_old_price' => null,
                'badge' => null,
                'description' => 'حذاء جلدي راقٍ يمنح الإطلالة الرسمية لمسة فاخرة ويتميز بخياطة دقيقة.',
                'short_description' => 'حذاء رسمي من الجلد الطبيعي بتشطيب فاخر.',
                'main_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD55sDnuTNCU7sBX1jr1StVjbWmYFeqZK4Gy_tpA6izp9D-hK7bZkpmRo2dZOfQP4KUjqpRKi86MyDd0QDfy__R8OTaSxS68fA5-b4xtYTrdutWDPR6bZd8wYTbfVUCphyByZDz-Yl8MPS2HTrOes1u1KdzS8s8D_vR6nKfySirpmhbBVYMuxKNadWMwau8YSMjRKphq53QPJM6UIRQCB20U0jc1Df1gdbsol42-LzV68izutNhL6PJza4Gw7gj4yAqMsIRyxw_z2I0',
                'gallery' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuD55sDnuTNCU7sBX1jr1StVjbWmYFeqZK4Gy_tpA6izp9D-hK7bZkpmRo2dZOfQP4KUjqpRKi86MyDd0QDfy__R8OTaSxS68fA5-b4xtYTrdutWDPR6bZd8wYTbfVUCphyByZDz-Yl8MPS2HTrOes1u1KdzS8s8D_vR6nKfySirpmhbBVYMuxKNadWMwau8YSMjRKphq53QPJM6UIRQCB20U0jc1Df1gdbsol42-LzV68izutNhL6PJza4Gw7gj4yAqMsIRyxw_z2I0',
                ],
                'colors' => ['بني', 'أسود'],
                'sizes' => ['41', '42', '43', '44'],
                'selected_size' => '42',
                'details' => [
                    'الوصف' => 'تصميم رسمي متين بنعل مريح وملمس فاخر يناسب المناسبات الخاصة.',
                    'الخامات والعناية' => 'جلد طبيعي، يستخدم ملمع الجلد للحفاظ على اللمعان.',
                ],
            ],
        ];
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
        return [
            ['name' => 'تيشيرتات', 'count' => 120],
            ['name' => 'قمصان', 'count' => 85],
            ['name' => 'بناطيل', 'count' => 64],
            ['name' => 'جواكت', 'count' => 42],
        ];
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
