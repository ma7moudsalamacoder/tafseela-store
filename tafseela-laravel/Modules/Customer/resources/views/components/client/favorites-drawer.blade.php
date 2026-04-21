@php
    $favorites = [
        [
            'name' => 'فستان مشجر حرير',
            'category' => 'حريمي - صيفي',
            'price' => '1,450 جنيه',
            'old_price' => null,
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA1e3t8dR8xZ2WI1MVX0Gqk8raZ9GUv7YaPyACYE4NdFCZyv_jRej1HZ5hgwDvEGUFNjpp2Ggb2i-KJJvdSIVIPB4D7hndDuZjPmWrs5yXhgpJoQ5F3CwhVdwoxRJfJV9ejc9XdgoYJUOXakvpAYgx_BQwT2GVe40SawcCY_aWVkn8K9Yr8WY5S8935KjXxxCLo06IcJ1wmOMevC9pQSreWx96ISzPU_PDNuRGJLtfxsKR_jK_CwTKOgO7wN2URxaWF29Qq02zL6uoB',
        ],
        [
            'name' => 'قميص كتان كاجوال',
            'category' => 'رجالي - أزرق فاتح',
            'price' => '850 جنيه',
            'old_price' => '1,200 جنيه',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAa8rxsCtnHO1uoqPKohyj3olgrRNYd84CD7ibbTxlOhJunn23RMdUvhV50rilc6g5xsGQ_Bz3Y6_Xi3llenb_loo06rLbJj2A5MY-DoJt46VO0LHC-q4_C_TuacMR1u3F4JMj1Ljr3TR_Js_TN_DGjG6a96fJulUh_UttCtpU5wRgwu7HoF0JwqHBOu_Qz_pKne5ROiSCvA5oWyansb_9tY7WE5Mz3MOeEqJBIlamFRHh5OYXaonC9MQawVhOYhPZoq8Au59PQYaLn',
        ],
        [
            'name' => 'بنطلون كلاسيك رمادي',
            'category' => 'رجالي - رسمي',
            'price' => '950 جنيه',
            'old_price' => null,
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDfMNJWS58aYPNNEez7zZBK5oYciY9gRf1GmsCiGl5SzDQjlijSF7npj2Mt4NvlkEPwpwhWpFmI7xkaz5-A16AUn3QOJq0vdNIyeOmDH8gyNS5jxRDEjW4aYPqGjFzkGzpH_TVCvOzCXirQkdZh9p42PP65T5aKazbGhn-0H8vn4zOGs6qOHiF7ASAXUd22n5J9ViCrJgx0ASgEWABTEchYdsy1T8PuXZjOWvjQJcpXXRLC7J7EyBtUkgOKd7YQ_qoisaPjpRaZMtSu',
        ],
    ];
@endphp

<div id="favorites-drawer" class="pointer-events-none fixed inset-0 z-[90] hidden" aria-hidden="true" data-drawer="favorites">
    <div class="absolute inset-0 bg-neutral-charcoal/40 opacity-0 backdrop-blur-sm transition-opacity duration-300" data-drawer-overlay></div>

    <aside class="absolute inset-y-0 right-0 flex h-full w-full max-w-md translate-x-full flex-col bg-white shadow-2xl transition-transform duration-500 dark:bg-background-dark">
        <div class="flex items-center justify-between border-b border-gray-100 px-8 py-6 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-3xl text-primary">favorite</span>
                <h2 class="text-2xl font-extrabold text-neutral-charcoal dark:text-white">المفضلة</h2>
                <span class="rounded-full bg-primary/10 px-2 py-0.5 text-xs font-bold text-primary">{{ count($favorites) }} قطع</span>
            </div>

            <button type="button" class="p-2 transition-colors hover:bg-gray-50 dark:hover:bg-gray-800" aria-label="إغلاق المفضلة" data-drawer-close>
                <span class="material-symbols-outlined text-gray-400">close</span>
            </button>
        </div>

        <div class="hide-scrollbar flex-grow space-y-8 overflow-y-auto p-8">
            @foreach ($favorites as $favorite)
                <div class="group flex gap-4">
                    <div class="h-32 w-24 flex-shrink-0 overflow-hidden bg-gray-50">
                        <img src="{{ $favorite['image'] }}" alt="{{ $favorite['name'] }}" class="h-full w-full object-cover">
                    </div>

                    <div class="flex flex-grow flex-col">
                        <div class="mb-1 flex items-start justify-between">
                            <h3 class="cursor-pointer text-sm font-bold text-neutral-charcoal transition-colors hover:text-primary dark:text-white">{{ $favorite['name'] }}</h3>
                            <button type="button" class="text-gray-300 transition-colors hover:text-red-500" aria-label="حذف من المفضلة">
                                <span class="material-symbols-outlined text-lg">delete</span>
                            </button>
                        </div>

                        <p class="mb-3 text-[10px] font-bold uppercase tracking-widest text-gray-400">{{ $favorite['category'] }}</p>

                        <div class="mt-auto flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="font-bold text-primary">{{ $favorite['price'] }}</span>
                                @if ($favorite['old_price'])
                                    <span class="text-[10px] text-gray-300 line-through">{{ $favorite['old_price'] }}</span>
                                @endif
                            </div>

                            <button type="button" class="flex items-center gap-2 bg-primary px-4 py-2 text-[10px] font-bold text-white transition-colors hover:bg-primary-dark">
                                <span class="material-symbols-outlined text-sm">shopping_bag</span>
                                أضف للسلة
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="space-y-4 border-t border-gray-100 p-8 dark:border-gray-800">
            <button type="button" class="flex w-full items-center justify-center gap-3 bg-neutral-charcoal py-5 text-sm font-extrabold uppercase tracking-widest text-white transition-colors hover:bg-primary">
                عرض كل المفضلة
                <span class="material-symbols-outlined">arrow_back</span>
            </button>

            <p class="text-center text-[11px] text-gray-400">
                احتفظ بقطعك المفضلة هنا لزيارتها لاحقاً ومقارنتها قبل الشراء.
            </p>
        </div>
    </aside>
</div>
