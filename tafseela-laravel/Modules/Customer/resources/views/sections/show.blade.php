<x-customer::layouts.client :title="'تفصيلة - '.$section['name']" :description="$section['description']">
    <section class="min-h-screen bg-background-light pt-8 dark:bg-background-dark">
        <div class="container mx-auto px-4 lg:px-12">
            <nav class="mb-8 flex justify-end text-[11px] font-bold uppercase tracking-widest text-gray-400">
                <ul class="flex items-center gap-3">
                    <li><a href="{{ route('customer.home') }}" class="transition-colors hover:text-primary">الرئيسية</a></li>
                    <li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">chevron_left</span> <span>{{ $section['parent'] }}</span></li>
                    <li class="flex items-center gap-2 text-primary"><span class="material-symbols-outlined text-sm">chevron_left</span> {{ $section['name'] }}</li>
                </ul>
            </nav>

            <div class="flex flex-col gap-12 lg:flex-row">
                <aside class="w-full flex-shrink-0 space-y-10 lg:w-72">
                    @php
                        $categoryRoutes = [
                            'تيشيرتات' => route('customer.products.index'),
                            'قمصان' => route('customer.sections.show', 'mens-shirts'),
                            'بناطيل' => route('customer.products.index'),
                            'جواكت' => route('customer.sections.show', 'mens-jackets'),
                        ];
                    @endphp
                    <div>
                        <h5 class="mb-6 border-r-4 border-primary pr-4 text-sm font-extrabold uppercase tracking-[0.2em]">الفئات</h5>
                        <ul class="space-y-4 text-xs font-bold text-gray-600 dark:text-gray-400">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ $categoryRoutes[$category['name']] ?? route('customer.products.index') }}" class="flex items-center justify-between transition-colors hover:text-primary {{ $category['name'] === 'قمصان' ? 'text-primary' : '' }}">
                                        <span>{{ $category['name'] }}</span>
                                        <span class="font-sans text-[10px] {{ $category['name'] === 'قمصان' ? '' : 'text-gray-300' }}">({{ $category['count'] }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <h5 class="mb-6 border-r-4 border-primary pr-4 text-sm font-extrabold uppercase tracking-[0.2em]">نطاق السعر</h5>
                        <div class="px-2">
                            <input type="range" min="0" max="5000" class="h-1 w-full cursor-pointer appearance-none rounded-lg bg-gray-200 accent-primary">
                            <div class="mt-4 flex justify-between text-[10px] font-bold text-gray-500">
                                <span>0 ج.م</span>
                                <span>5000 ج.م</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h5 class="mb-6 border-r-4 border-primary pr-4 text-sm font-extrabold uppercase tracking-[0.2em]">اللون</h5>
                        <div class="flex flex-wrap gap-3">
                            @foreach ($colorOptions as $index => $color)
                                <button type="button" class="h-8 w-8 rounded-full border border-gray-100 {{ $index === 0 ? 'bg-neutral-charcoal' : ($index === 1 ? 'bg-white' : ($index === 2 ? 'bg-blue-900' : ($index === 3 ? 'bg-primary' : 'bg-red-800'))) }}"></button>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h5 class="mb-6 border-r-4 border-primary pr-4 text-sm font-extrabold uppercase tracking-[0.2em]">المقاس</h5>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach ($sizeOptions as $size)
                                <button type="button" class="py-2 text-[10px] font-bold transition-all {{ $size === 'M' ? 'border border-primary bg-primary text-white' : 'border border-gray-200 hover:border-primary hover:text-primary dark:border-gray-700' }}">
                                    {{ $size }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </aside>

                <div class="flex-grow">
                    <div class="mb-10 border-b border-gray-100 pb-6 dark:border-gray-800">
                        <div class="flex flex-col items-start justify-between gap-6 md:flex-row md:items-center">
                            <div>
                                <h2 class="text-2xl font-extrabold">{{ $section['name'] }} <span class="mr-4 text-sm font-light text-gray-300">({{ $section['product_count'] }} منتج)</span></h2>
                                <p class="mt-3 max-w-2xl text-sm text-gray-500 dark:text-gray-400">{{ $section['description'] }}</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">ترتيب حسب:</span>
                                <select class="cursor-pointer border-none bg-transparent text-xs font-bold focus:ring-0">
                                    <option>الأحدث</option>
                                    <option>السعر: من الأقل للأعلى</option>
                                    <option>السعر: من الأعلى للأقل</option>
                                    <option>الأكثر مبيعاً</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-x-8 gap-y-16 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($products as $product)
                            <article class="group product-card-shadow">
                                <a href="{{ route('customer.products.show', $product['slug']) }}" class="block">
                                    <div class="relative mb-6 aspect-[4/5] overflow-hidden bg-gray-50">
                                        <img src="{{ $product['main_image'] }}" alt="{{ $product['name'] }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                                        <div class="absolute inset-0 bg-black/5 opacity-0 transition-opacity group-hover:opacity-100"></div>
                                        <div class="absolute bottom-4 left-4 right-4 flex translate-y-10 gap-2 opacity-0 transition-all duration-500 group-hover:translate-y-0 group-hover:opacity-100">
                                            <button type="button" class="flex flex-grow items-center justify-center gap-2 bg-white py-4 text-[10px] font-bold uppercase tracking-widest text-neutral-charcoal transition-colors hover:bg-primary hover:text-white">
                                                <span class="material-symbols-outlined text-base">shopping_bag</span>
                                                إضافة سريعة
                                            </button>
                                            <button type="button" class="flex w-12 items-center justify-center bg-white text-neutral-charcoal transition-colors hover:text-red-500">
                                                <span class="material-symbols-outlined">favorite</span>
                                            </button>
                                        </div>
                                        @if ($product['badge'])
                                            <span class="absolute right-4 top-4 bg-primary px-3 py-1 text-[9px] font-extrabold tracking-widest text-white">{{ $product['badge'] }}</span>
                                        @endif
                                    </div>
                                    <div class="space-y-1">
                                        <h4 class="text-base font-bold tracking-tight transition-colors hover:text-primary">{{ $product['name'] }}</h4>
                                        <p class="text-[9px] font-bold uppercase tracking-widest text-gray-400">{{ $product['subtitle'] }}</p>
                                        <div class="flex items-center gap-3 pt-2">
                                            <span class="text-lg font-bold text-primary">{{ $product['formatted_price'] }}</span>
                                            @if ($product['formatted_old_price'])
                                                <span class="text-sm text-gray-300 line-through">{{ $product['formatted_old_price'] }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>

                    <div class="mt-12 flex items-center justify-center gap-2">
                        <button type="button" class="flex h-12 w-12 items-center justify-center border border-gray-100 transition-all hover:border-primary hover:text-primary">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                        <button type="button" class="h-12 w-12 border border-primary bg-primary text-xs font-bold text-white">1</button>
                        <button type="button" class="h-12 w-12 border border-gray-100 text-xs font-bold transition-all hover:border-primary hover:text-primary">2</button>
                        <button type="button" class="h-12 w-12 border border-gray-100 text-xs font-bold transition-all hover:border-primary hover:text-primary">3</button>
                        <button type="button" class="flex h-12 w-12 items-center justify-center border border-gray-100 transition-all hover:border-primary hover:text-primary">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-customer::components.client.newsletter />
</x-customer::layouts.client>
