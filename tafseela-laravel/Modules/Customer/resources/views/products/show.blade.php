<x-customer::layouts.client :title="'تفصيلة - '.$product['name']" :description="$product['description']">
    <section class="container mx-auto px-4 py-12 lg:px-12 lg:py-20">
        <div class="grid grid-cols-1 gap-16 lg:grid-cols-12">
            <div class="order-1 lg:order-2 lg:col-span-7">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2 aspect-[4/5] overflow-hidden bg-gray-100">
                        <img src="{{ $product['gallery'][0] }}" alt="{{ $product['name'] }}" class="h-full w-full object-cover">
                    </div>
                    @foreach (array_slice($product['gallery'], 1) as $image)
                        <div class="aspect-square overflow-hidden bg-gray-100">
                            <img src="{{ $image }}" alt="Detail view" class="h-full w-full object-cover">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="order-2 flex flex-col lg:order-1 lg:col-span-5">
                <div class="mb-10">
                    <nav class="mb-6 flex gap-2 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                        <a href="{{ route('customer.home') }}" class="hover:text-primary">الرئيسية</a>
                        <span>/</span>
                        <a href="{{ route('customer.sections.show', $product['section_slug']) }}" class="hover:text-primary">{{ $product['section_name'] }}</a>
                        <span>/</span>
                        <span class="text-neutral-charcoal dark:text-white">{{ $product['name'] }}</span>
                    </nav>
                    <h2 class="mb-4 text-4xl font-extrabold text-neutral-charcoal dark:text-white lg:text-5xl">{{ $product['name'] }}</h2>
                    <div class="mb-8 flex items-center gap-6">
                        <span class="text-3xl font-extrabold text-primary">{{ $product['formatted_price'] }}</span>
                        @if ($product['formatted_old_price'])
                            <span class="text-xl text-gray-300 line-through">{{ $product['formatted_old_price'] }}</span>
                        @endif
                    </div>
                    <p class="leading-relaxed text-gray-500 dark:text-gray-400">{{ $product['description'] }}</p>
                </div>

                <div class="mb-10">
                    <h3 class="mb-4 text-[11px] font-extrabold uppercase tracking-widest">الألوان المتوفرة</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach ($product['colors'] as $index => $color)
                            <button type="button" class="min-w-20 border px-4 py-3 text-xs font-bold transition-all {{ $index === 0 ? 'border-primary bg-primary text-white' : 'border-gray-200 hover:border-primary hover:text-primary dark:border-gray-700' }}">
                                {{ $color }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="mb-10">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-[11px] font-extrabold uppercase tracking-widest">المقاس</h3>
                        <button type="button" class="text-[10px] font-bold text-primary hover:underline">جدول المقاسات</button>
                    </div>
                    <div class="grid grid-cols-5 gap-2">
                        @foreach ($product['sizes'] as $size)
                            <button type="button" class="flex h-14 items-center justify-center font-bold text-sm transition-all {{ $size === $product['selected_size'] ? 'border-2 border-primary text-primary' : 'border border-gray-200 hover:border-primary hover:text-primary dark:border-gray-700' }}">
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="mb-10 flex flex-col gap-4 sm:flex-row">
                    <button type="button" class="flex flex-1 items-center justify-center gap-4 bg-primary py-6 text-sm font-extrabold uppercase tracking-[0.2em] text-white shadow-xl shadow-primary/20 transition-all duration-300 hover:bg-primary-dark">
                        إضافة إلى السلة
                        <span class="material-symbols-outlined">shopping_bag</span>
                    </button>
                    <button type="button" class="flex w-full items-center justify-center gap-4 border-2 border-neutral-charcoal/10 py-6 text-sm font-extrabold uppercase tracking-[0.2em] transition-all hover:bg-neutral-charcoal hover:text-white dark:border-white/20 sm:w-auto sm:px-8">
                        <span class="material-symbols-outlined">favorite</span>
                        أضف للمفضلة
                    </button>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800">
                    @foreach ($product['details'] as $title => $content)
                        <details class="group border-b border-gray-100 dark:border-gray-800" @if ($loop->first) open @endif>
                            <summary class="flex cursor-pointer items-center justify-between py-6">
                                <span class="font-bold">{{ $title }}</span>
                                <span class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                            </summary>
                            <div class="pb-6 text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                                {{ $content }}
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 pb-20 lg:px-12">
        <div class="mb-12 text-center">
            <h3 class="mb-2 text-2xl font-extrabold">قد يعجبك أيضاً</h3>
            <div class="mx-auto h-1 w-12 bg-primary"></div>
        </div>
        <div class="grid grid-cols-2 gap-8 lg:grid-cols-4">
            @foreach (array_slice($relatedProducts, 0, 4) as $item)
                <a href="{{ route('customer.products.show', $item['slug']) }}" class="space-y-4">
                    <div class="group relative aspect-[3/4] overflow-hidden bg-gray-100">
                        <img src="{{ $item['main_image'] }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                    </div>
                    <div>
                        <h4 class="text-sm font-bold">{{ $item['name'] }}</h4>
                        <p class="mt-1 text-sm font-bold text-primary">{{ $item['formatted_price'] }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <x-customer::components.client.newsletter />
</x-customer::layouts.client>
