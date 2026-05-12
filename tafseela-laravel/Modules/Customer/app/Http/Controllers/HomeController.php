<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Modules\Core\Services\SettingsManager;
use Modules\Product\Enums\ItemStatus;
use Modules\Product\Enums\ProductSlugs;
use Modules\Product\Models\Category;
use Modules\Product\Models\Product;
use Modules\Product\Services\ProductManager;

class HomeController extends Controller
{
    protected $productManager;
    protected $settingsManager;
    public function __construct()
    {
        $this->productManager = new ProductManager();
        $this->settingsManager = new SettingsManager();
    }
    public function __invoke(): View
    {

        $cartCount = 0;
        $wishlistCount = 0;


        $hero = $this->settingsManager->get('hero');

        if (!$hero) {
            $hero = [
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAtKicfpnDGxV6OZ2AcKbavKPy2wiKTHJpXSR_qEVlqnyuzIWeOETtGbC1_xTCE3wiEs37Je1VvyoWrDgJlz4-W0sOonxdwLSRtNxXrYspmmROYfEJ9Bgx31eWI7Aha_atd1OG0Q6EAEIuvh7oHir9DLMvuPUNLiVe2XwNwWYuAOtONslDp2u_F7V9pMFNeviQfyvM92F3CZlvlpUvctZJLIOB_tmP_EKmLrmB26IrTo3Lm4KX8ty7bDv3v09A3LtqGyo_7BJUoin53',
                'badge' => 'مجموعة خريف وشتاء 2024',
                'description' => 'اكتشفوا أحدث التصاميم العصرية التي تجمع بين الأصالة والراحة. قطع حصرية صممت لتعكس شخصيتكم الراقية.',
                'collectionSlug' => 'winter-2024'
            ];
        }

        $categories = $this->productManager->getAllCategoriesWithDetails(0,ItemStatus::SHOW)->each(function($cat) {
            $cat->slug = strtolower(ProductSlugs::tryFrom($cat->category)?->name ?? Str::slug($cat->category));
            $cat->image = $cat->cover_image ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuD55sDnuTNCU7sBX1jr1StVjbWmYFeqZK4Gy_tpA6izp9D-hK7bZkpmRo2dZOfQP4KUjqpRKi86MyDd0QDfy__R8OTaSxS68fA5-b4xtYTrdutWDPR6bZd8wYTbfVUCphyByZDz-Yl8MPS2HTrOes1u1KdzS8s8D_vR6nKfySirpmhbBVYMuxKNadWMwau8YSMjRKphq53QPJM6UIRQCB20U0jc1Df1gdbsol42-LzV68izutNhL6PJza4Gw7gj4yAqMsIRyxw_z2I0';
            $cat->alt = $cat->category;
            $cat->title = $cat->category;
            $cat->count = $cat->products()->count() . ' منتج';
        });


        if ($categories->isEmpty()) {
            $categories = [
                ['slug' => 'women', 'title' => 'حريمي', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD55sDnuTNCU7sBX1jr1StVjbWmYFeqZK4Gy_tpA6izp9D-hK7bZkpmRo2dZOfQP4KUjqpRKi86MyDd0QDfy__R8OTaSxS68fA5-b4xtYTrdutWDPR6bZd8wYTbfVUCphyByZDz-Yl8MPS2HTrOes1u1KdzS8s8D_vR6nKfySirpmhbBVYMuxKNadWMwau8YSMjRKphq53QPJM6UIRQCB20U0jc1Df1gdbsol42-LzV68izutNhL6PJza4Gw7gj4yAqMsIRyxw_z2I0', 'alt' => 'Women', 'count' => 'أكثر من 500 منتج'],
                ['slug' => 'men', 'title' => 'رجالي', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAbi3E7Kulf-O39skm-_q21SAHf1y-hZ4ToIZmrNSJz5N7tKArej1WXHzgD2l1Jvtm7wor_gDh9NC2j0ZAMXdV1bCjcvYAqXP_xWrT6PSJYaKk9-1PdFQopPgmBmBFgWDA5_sJ3Vnxzp9IkrlliKv5tQZjFVT3j-_BoV5Y9Ij4sr1ctB3EuNxssOGOTkdmFQ8tWUJ1V3wJAXvqDNNnN-M_9wCPr9ClSqkeODujbxIdxwFE12bb2qCRHl3mp8xOFHnrxg00RkrqoykTB', 'alt' => 'Men', 'count' => 'أكثر من 300 منتج'],
                ['slug' => 'kids', 'title' => 'أطفال', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA_KDHhWT1-X0rIuOcEhxP-EU-nO_pcSklmFlIcEDsSVWYTnAjV5tv-70335__WlmNZeONCunCpxHCNvW-ndgSlkh39C5SA-w1Plwc_-3Cl04Mynp6q_MiWD7eTUjEk0quAT4XJln7DpzzRZv72_wD5TlIC8OPeabULtEPWF2bR5sVwDhmtWaHp-g5nQK1GZO5wL8kT5xgNKOb70_y8yXdNVAvN0vX_2xQv6W_tt2rEf8mdFghPHFPeQnpLFzA0ygGH7mQJz4ov4dmS', 'alt' => 'Kids', 'count' => 'أكثر من 200 منتج'],
            ];
        }

        $newArrivals = Product::where('status', 'show')->latest()->take(8)->get()->map(function($prod) {
            return [
                'slug'           => Str::slug($prod->name),
                'image'          => $prod->image ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuAa8rxsCtnHO1uoqPKohyj3olgrRNYd84CD7ibbTxlOhJunn23RMdUvhV50rilc6g5xsGQ_Bz3Y6_Xi3llenb_loo06rLbJj2A5MY-DoJt46VO0LHC-q4_C_TuacMR1u3F4JMj1Ljr3TR_Js_TN_DGjG6a96fJulUh_UttCtpU5wRgwu7HoF0JwqHBOu_Qz_pKne5ROiSCvA5oWyansb_9tY7WE5Mz3MOeEqJBIlamFRHh5OYXaonC9MQawVhOYhPZoq8Au59PQYaLn',
                'alt'            => $prod->name,
                'badge'          => 'جديد',
                'name'           => $prod->name,
                'category'       => $prod->category?->title ?? 'غير مصنف',
                'price'          => number_format($prod->price, 2) . ' ج.م',
                'original_price' => null
            ];
        });

        if ($newArrivals->isEmpty()) {
            $newArrivals = [
                [
                    'slug' => 'linen-shirt',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAa8rxsCtnHO1uoqPKohyj3olgrRNYd84CD7ibbTxlOhJunn23RMdUvhV50rilc6g5xsGQ_Bz3Y6_Xi3llenb_loo06rLbJj2A5MY-DoJt46VO0LHC-q4_C_TuacMR1u3F4JMj1Ljr3TR_Js_TN_DGjG6a96fJulUh_UttCtpU5wRgwu7HoF0JwqHBOu_Qz_pKne5ROiSCvA5oWyansb_9tY7WE5Mz3MOeEqJBIlamFRHh5OYXaonC9MQawVhOYhPZoq8Au59PQYaLn',
                    'alt' => 'Casual linen shirt',
                    'badge' => 'جديد',
                    'name' => 'قميص كتان كاجوال',
                    'category' => 'رجالي - أزرق فاتح',
                    'price' => '850 جنيه',
                    'original_price' => '1,200 جنيه'
                ],
                [
                    'slug' => 'silk-dress',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA1e3t8dR8xZ2WI1MVX0Gqk8raZ9GUv7YaPyACYE4NdFCZyv_jRej1HZ5hgwDvEGUFNjpp2Ggb2i-KJJvdSIVIPB4D7hndDuZjPmWrs5yXhgpJoQ5F3CwhVdwoxRJfJV9ejc9XdgoYJUOXakvpAYgx_BQwT2GVe40SawcCY_aWVkn8K9Yr8WY5S8935KjXxxCLo06IcJ1wmOMevC9pQSreWx96ISzPU_PDNuRGJLtfxsKR_jK_CwTKOgO7wN2URxaWF29Qq02zL6uoB',
                    'alt' => 'Floral silk maxi dress',
                    'badge' => null,
                    'name' => 'فستان مشجر حرير',
                    'category' => 'حريمي - صيفي',
                    'price' => '1,450 جنيه',
                    'original_price' => null
                ],
                [
                    'slug' => 'denim-jacket',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDuqwrlfWKG6vFStSzVmd0f2X4f_P-ExhbD-4U2atWtuMsdC3ucmUuQ4gdvfeSIKUq3KCqQ1rZJJKzditbqLMvAvo0xv_6p14wD_gt3jr7oC7Qvl-_Ov5ptoM57Cv4ZuB7msBqwVPN1niFmaSEMj9d5MbyHQqB0FGmBVSgWUC8fl7Z3LjeeIdjYtquM_ehZQsFC9BQY9juJFJu8oRg3ibAPuEYm_30mdxrFj3mOvbd7ziu8oe3e7SqYItiSw0wM0Sq2ilUG9UPWctWe',
                    'alt' => 'Denim jacket',
                    'badge' => 'خصم 20%',
                    'name' => 'جاكيت جينز عصري',
                    'category' => 'أطفال - كحلي',
                    'price' => '600 جنيه',
                    'original_price' => '750 جنيه'
                ],
                [
                    'slug' => 'formal-trousers',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDfMNJWS58aYPNNEez7zZBK5oYciY9gRf1GmsCiGl5SzDQjlijSF7npj2Mt4NvlkEPwpwhWpFmI7xkaz5-A16AUn3QOJq0vdNIyeOmDH8gyNS5jxRDEjW4aYPqGjFzkGzpH_TVCvOzCXirQkdZh9p42PP65T5aKazbGhn-0H8vn4zOGs6qOHiF7ASAXUd22n5J9ViCrJgx0ASgEWABTEchYdsy1T8PuXZjOWvjQJcpXXRLC7J7EyBtUkgOKd7YQ_qoisaPjpRaZMtSu',
                    'alt' => 'Classic formal trousers',
                    'badge' => null,
                    'name' => 'بنطلون كلاسيك رمادي',
                    'category' => 'رجالي - رسمي',
                    'price' => '950 جنيه',
                    'original_price' => null
                ],
            ];
        }

        return view('customer::home', compact('cartCount', 'wishlistCount', 'hero', 'categories', 'newArrivals'));
    }
}
