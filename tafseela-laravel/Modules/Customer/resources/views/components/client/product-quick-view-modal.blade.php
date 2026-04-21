@props([
    'initialProduct' => null,
])

@php
    $product = $initialProduct;
@endphp

<div id="quick-view-modal" class="pointer-events-none fixed inset-0 z-[95] hidden" aria-hidden="true" data-quick-view-modal>
    <div class="absolute inset-0 bg-black/40 opacity-0 backdrop-blur-sm transition-opacity duration-300" data-quick-view-overlay></div>

    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="hide-scrollbar relative flex max-h-[90vh] w-full max-w-5xl translate-y-8 flex-col overflow-hidden bg-white opacity-0 shadow-2xl transition-all duration-300 dark:bg-background-dark md:flex-row" data-quick-view-panel>
            <button type="button" class="absolute right-4 top-4 z-50 text-neutral-charcoal transition-colors hover:text-primary dark:text-gray-400" aria-label="إغلاق نظرة سريعة" data-quick-view-close>
                <span class="material-symbols-outlined text-3xl">close</span>
            </button>

            <div class="flex h-full w-full md:w-3/5">
                <div class="hidden flex-col gap-4 border-l border-gray-100 p-4 dark:border-gray-800 lg:flex">
                    @foreach (($product['gallery'] ?? []) as $image)
                        <div class="h-20 w-16 overflow-hidden border border-gray-200 bg-gray-50 dark:border-gray-700">
                            <img src="{{ $image }}" alt="Thumbnail" class="h-full w-full object-cover" data-quick-view-thumb>
                        </div>
                    @endforeach
                </div>

                <div class="relative flex-grow overflow-hidden bg-gray-50">
                    <img src="{{ $product['main_image'] ?? '' }}" alt="{{ $product['name'] ?? '' }}" class="h-full w-full object-cover" data-quick-view-image>
                    <span class="absolute left-4 top-4 bg-primary px-4 py-1.5 text-[10px] font-extrabold uppercase tracking-widest text-white" data-quick-view-badge>
                        {{ $product['badge'] ?? 'وصلنا حديثاً' }}
                    </span>
                </div>
            </div>

            <div class="hide-scrollbar flex w-full flex-col justify-between overflow-y-auto p-8 text-right md:w-2/5 lg:p-12">
                <div>
                    <p class="mb-2 text-[10px] font-bold uppercase tracking-[0.2em] text-primary" data-quick-view-subtitle>{{ $product['subtitle'] ?? '' }}</p>
                    <h2 class="mb-4 text-3xl font-extrabold leading-tight text-neutral-charcoal dark:text-white" data-quick-view-name>{{ $product['name'] ?? '' }}</h2>

                    <div class="mb-6 flex items-center gap-3">
                        <span class="text-2xl font-bold text-primary" data-quick-view-price>{{ $product['formatted_price'] ?? '' }}</span>
                        <span class="text-sm text-gray-300 line-through" data-quick-view-old-price>{{ $product['formatted_old_price'] ?? '' }}</span>
                    </div>

                    <p class="mb-8 text-sm leading-relaxed text-gray-500 dark:text-gray-400" data-quick-view-description>{{ $product['description'] ?? '' }}</p>

                    <div class="mb-8">
                        <h3 class="mb-4 text-[11px] font-extrabold uppercase tracking-widest">اللون المتوفر</h3>
                        <div class="flex flex-wrap gap-3" data-quick-view-colors>
                            @foreach (($product['colors'] ?? []) as $index => $color)
                                <span class="flex min-w-16 items-center justify-center border border-gray-200 px-3 py-2 text-[10px] font-bold dark:border-gray-700 {{ $index === 0 ? 'bg-primary text-white border-primary' : '' }}">
                                    {{ $color }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-10">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-[11px] font-extrabold uppercase tracking-widest">اختر المقاس</h3>
                            <button type="button" class="text-[10px] font-bold text-primary hover:underline">جدول المقاسات</button>
                        </div>
                        <div class="grid grid-cols-5 gap-2" data-quick-view-sizes>
                            @foreach (($product['sizes'] ?? []) as $size)
                                <span class="border border-gray-200 py-3 text-center text-[11px] font-bold dark:border-gray-700 {{ $size === ($product['selected_size'] ?? null) ? 'border-primary bg-primary text-white' : '' }}">
                                    {{ $size }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex gap-4">
                        <button type="button" class="flex-grow bg-primary py-5 text-[12px] font-extrabold uppercase tracking-[0.2em] text-white shadow-xl shadow-primary/20 transition-all duration-300 hover:bg-primary-dark">
                            أضف إلى السلة
                        </button>
                        <button type="button" class="flex w-16 items-center justify-center border border-gray-200 text-neutral-charcoal transition-colors hover:text-primary dark:border-gray-700 dark:text-white">
                            <span class="material-symbols-outlined text-2xl">favorite</span>
                        </button>
                    </div>
                    <div class="pt-4 text-center">
                        <a href="{{ $product ? route('customer.products.show', $product['slug']) : route('customer.products.index') }}" class="border-b border-transparent pb-1 text-[11px] font-bold uppercase tracking-widest text-gray-400 transition-colors hover:border-primary/30 hover:text-primary" data-quick-view-link>
                            رؤية كامل التفاصيل
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
