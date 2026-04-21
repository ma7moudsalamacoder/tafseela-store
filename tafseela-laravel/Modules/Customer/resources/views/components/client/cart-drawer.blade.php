@php
    $cartItems = [
        [
            'name' => 'قميص كتان كاجوال',
            'details' => 'اللون: أزرق فاتح | المقاس: L',
            'quantity' => 1,
            'price' => '850 جنيه',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAa8rxsCtnHO1uoqPKohyj3olgrRNYd84CD7ibbTxlOhJunn23RMdUvhV50rilc6g5xsGQ_Bz3Y6_Xi3llenb_loo06rLbJj2A5MY-DoJt46VO0LHC-q4_C_TuacMR1u3F4JMj1Ljr3TR_Js_TN_DGjG6a96fJulUh_UttCtpU5wRgwu7HoF0JwqHBOu_Qz_pKne5ROiSCvA5oWyansb_9tY7WE5Mz3MOeEqJBIlamFRHh5OYXaonC9MQawVhOYhPZoq8Au59PQYaLn',
        ],
        [
            'name' => 'فستان مشجر حرير',
            'details' => 'اللون: صيفي | المقاس: M',
            'quantity' => 1,
            'price' => '1,450 جنيه',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA1e3t8dR8xZ2WI1MVX0Gqk8raZ9GUv7YaPyACYE4NdFCZyv_jRej1HZ5hgwDvEGUFNjpp2Ggb2i-KJJvdSIVIPB4D7hndDuZjPmWrs5yXhgpJoQ5F3CwhVdwoxRJfJV9ejc9XdgoYJUOXakvpAYgx_BQwT2GVe40SawcCY_aWVkn8K9Yr8WY5S8935KjXxxCLo06IcJ1wmOMevC9pQSreWx96ISzPU_PDNuRGJLtfxsKR_jK_CwTKOgO7wN2URxaWF29Qq02zL6uoB',
        ],
    ];
@endphp

<div id="cart-drawer" class="pointer-events-none fixed inset-0 z-[90] hidden" aria-hidden="true" data-drawer="cart">
    <div class="absolute inset-0 bg-black/40 opacity-0 backdrop-blur-sm transition-opacity duration-300" data-drawer-overlay></div>

    <aside class="absolute inset-y-0 right-0 flex h-full w-full max-w-[450px] translate-x-full flex-col bg-white shadow-2xl transition-transform duration-500 dark:bg-background-dark">
        <div class="flex items-center justify-between bg-primary-dark p-6 text-white">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined">shopping_bag</span>
                <h2 class="text-xl font-bold tracking-tight">حقيبة التسوق</h2>
                <span class="rounded-full bg-white/20 px-2 py-0.5 text-[10px] font-bold">{{ count($cartItems) }} قطعة</span>
            </div>

            <button type="button" class="transition-transform duration-300 hover:rotate-90" aria-label="إغلاق السلة" data-drawer-close>
                <span class="material-symbols-outlined text-3xl">close</span>
            </button>
        </div>

        <div class="hide-scrollbar flex-grow space-y-8 overflow-y-auto p-6">
            @foreach ($cartItems as $item)
                <div class="group flex gap-4">
                    <div class="h-32 w-24 flex-shrink-0 overflow-hidden bg-gray-50">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                    </div>

                    <div class="flex flex-grow flex-col justify-between py-1">
                        <div>
                            <div class="flex items-start justify-between">
                                <h3 class="cursor-pointer text-sm font-bold text-neutral-charcoal transition-colors hover:text-primary dark:text-white">{{ $item['name'] }}</h3>
                                <button type="button" class="text-gray-400 transition-colors hover:text-red-500" aria-label="حذف من السلة">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </div>

                            <p class="mt-1 text-xs text-gray-500">{{ $item['details'] }}</p>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center border border-gray-200 dark:border-gray-700">
                                <button type="button" class="px-2 py-1 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800" aria-label="تقليل الكمية">
                                    <span class="material-symbols-outlined text-xs">remove</span>
                                </button>
                                <span class="px-3 font-sans text-xs font-bold">{{ $item['quantity'] }}</span>
                                <button type="button" class="px-2 py-1 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800" aria-label="زيادة الكمية">
                                    <span class="material-symbols-outlined text-xs">add</span>
                                </button>
                            </div>

                            <span class="font-bold text-primary">{{ $item['price'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="sticky bottom-0 border-t border-gray-100 bg-white p-6 dark:border-gray-800 dark:bg-background-dark">
            <div class="mb-6 flex items-center justify-between">
                <span class="font-medium text-gray-500">المجموع الفرعي</span>
                <span class="text-xl font-bold text-neutral-charcoal dark:text-white">2,300 جنيه</span>
            </div>

            <p class="mb-6 text-center text-[11px] text-gray-400">الشحن والضرائب يتم حسابها عند إتمام الدفع</p>

            <div class="space-y-3">
                <button type="button" class="flex w-full items-center justify-center gap-3 bg-primary py-5 text-sm font-extrabold tracking-[0.2em] text-white shadow-lg transition-colors hover:bg-primary-dark">
                    إتمام الشراء
                    <span class="material-symbols-outlined">arrow_back</span>
                </button>

                <button type="button" class="w-full border border-neutral-charcoal/10 py-4 text-[12px] font-bold text-neutral-charcoal transition-colors hover:bg-gray-50 dark:border-white/10 dark:text-white dark:hover:bg-gray-800">
                    عرض حقيبة التسوق
                </button>
            </div>
        </div>
    </aside>
</div>
