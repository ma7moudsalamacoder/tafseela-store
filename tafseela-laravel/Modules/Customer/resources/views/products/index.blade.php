<x-customer::layouts.client title="تفصيلة - جميع المنتجات" description="تصفح جميع منتجات تفصيلة للأزياء العصرية">
    <section class="container mx-auto px-4 py-12 lg:px-12">
        <div class="mb-10 text-right">
            <div class="mb-4 flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                <a href="{{ route('customer.home') }}" class="hover:text-primary">الرئيسية</a>
                <span class="material-symbols-outlined text-[12px]">chevron_left</span>
                <span class="text-neutral-charcoal dark:text-white">جميع المنتجات</span>
            </div>
            <h2 class="text-4xl font-extrabold text-neutral-charcoal dark:text-white">جميع المنتجات</h2>
        </div>

        <div class="flex flex-col gap-12 lg:flex-row">
            <aside class="w-full flex-shrink-0 space-y-10 lg:w-72">
                <div class="border-b border-gray-100 pb-8 dark:border-gray-800">
                    <h3 class="mb-6 text-sm font-extrabold uppercase tracking-widest">التصنيف</h3>
                    <div class="space-y-4">
                        @foreach (['رجالي', 'حريمي', 'أطفال'] as $category)
                            <label class="group flex cursor-pointer items-center gap-3">
                                <input type="checkbox" class="h-4 w-4 rounded-none border-gray-300 text-primary transition-all focus:ring-primary">
                                <span class="text-xs font-bold text-gray-500 transition-colors group-hover:text-primary">{{ $category }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="border-b border-gray-100 pb-8 dark:border-gray-800">
                    <h3 class="mb-6 text-sm font-extrabold uppercase tracking-widest">المقاس</h3>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach ($sizeOptions as $size)
                            <button type="button" class="border py-2 text-[10px] font-bold transition-all {{ $size === 'M' ? 'border-primary bg-primary text-white' : 'border-gray-200 hover:border-primary hover:text-primary dark:border-gray-700' }}">
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="border-b border-gray-100 pb-8 dark:border-gray-800">
                    <h3 class="mb-6 text-sm font-extrabold uppercase tracking-widest">اللون</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach ($colorOptions as $index => $color)
                            <button type="button" class="h-8 w-8 rounded-full border border-gray-200 ring-offset-2 transition-all hover:ring-1 hover:ring-primary dark:border-gray-700 {{ $index === 3 ? 'ring-2 ring-primary' : '' }}" style="background-color: {{ $color }}"></button>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h3 class="mb-6 text-sm font-extrabold uppercase tracking-widest">نطاق السعر</h3>
                    <div class="space-y-6">
                        <input type="range" min="0" max="5000" class="h-1 w-full cursor-pointer appearance-none rounded-lg bg-gray-200 accent-primary">
                        <div class="flex items-center justify-between text-[11px] font-bold">
                            <span class="text-gray-400">0 ج.م</span>
                            <span class="bg-neutral-beige px-3 py-1 text-primary dark:bg-gray-800">5000 ج.م</span>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="flex-grow">
                <div class="mb-8 flex flex-col items-center justify-between gap-4 border-b border-gray-50 pb-6 text-[11px] font-bold sm:flex-row dark:border-gray-800">
                    <span class="uppercase tracking-widest text-gray-400">عرض 1 - {{ count($products) }} من أصل 48 منتج</span>
                    <div class="flex items-center gap-4">
                        <label class="text-gray-400">ترتيب حسب:</label>
                        <select class="cursor-pointer border-none bg-transparent text-[11px] font-bold text-neutral-charcoal focus:ring-0 dark:text-white">
                            <option>الأحدث</option>
                            <option>السعر: من الأقل للأعلى</option>
                            <option>السعر: من الأعلى للأقل</option>
                            <option>الأكثر مبيعاً</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($products as $product)
                        <article class="group product-card-shadow relative">
                            <div class="relative mb-6 aspect-[4/5] overflow-hidden bg-gray-50">
                                <button
                                    type="button"
                                    class="absolute inset-0 z-10"
                                    data-quick-view-target
                                    data-product='@json($product, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)'
                                    aria-label="عرض {{ $product['name'] }}"
                                ></button>

                                <img src="{{ $product['main_image'] }}" alt="{{ $product['name'] }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">

                                <div class="absolute inset-0 z-20 flex flex-col items-center justify-center gap-6 bg-white/60 p-6 opacity-0 backdrop-blur-[2px] transition-opacity duration-300 group-hover:opacity-100 dark:bg-black/40">
                                    <p class="mb-2 text-[10px] font-extrabold uppercase tracking-widest text-neutral-charcoal dark:text-white">اختر المقاس</p>
                                    <div class="flex gap-2">
                                        @foreach (array_slice($product['sizes'], 0, 4) as $size)
                                            <button type="button" class="flex h-10 w-10 items-center justify-center border border-neutral-charcoal/20 bg-white/50 text-[11px] font-bold transition-all hover:border-primary hover:text-primary dark:border-white/20 dark:bg-black/20">
                                                {{ $size }}
                                            </button>
                                        @endforeach
                                    </div>
                                    <button type="button" class="w-full bg-primary py-4 text-[11px] font-extrabold uppercase tracking-[0.2em] text-white shadow-lg transition-all duration-300 hover:bg-primary-dark" data-ignore-quick-view>
                                        أضف إلى السلة
                                    </button>
                                </div>

                                <button type="button" class="absolute left-4 top-4 z-30 flex h-10 w-10 items-center justify-center rounded-full bg-white/80 text-neutral-charcoal shadow-sm backdrop-blur-sm transition-colors hover:text-primary" data-ignore-quick-view>
                                    <span class="material-symbols-outlined text-xl">favorite</span>
                                </button>

                                @if ($product['badge'])
                                    <span class="absolute right-4 top-4 z-30 bg-primary px-3 py-1 text-[9px] font-extrabold uppercase tracking-widest text-white">{{ $product['badge'] }}</span>
                                @endif
                            </div>

                            <div class="px-2">
                                <h4 class="cursor-pointer text-lg font-bold tracking-tight transition-colors hover:text-primary" data-quick-view-target data-product='@json($product, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)'>{{ $product['name'] }}</h4>
                                <p class="mb-3 text-[10px] font-bold uppercase tracking-widest text-gray-400">{{ $product['subtitle'] }}</p>
                                <div class="flex items-center gap-3">
                                    <span class="text-xl font-bold text-primary">{{ $product['formatted_price'] }}</span>
                                    @if ($product['formatted_old_price'])
                                        <span class="text-sm text-gray-300 line-through">{{ $product['formatted_old_price'] }}</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-12 flex justify-center">
                    <button type="button" class="bg-primary px-10 py-4 text-[12px] font-extrabold uppercase tracking-[0.2em] text-white transition-all duration-300 hover:bg-primary-dark">
                        تحميل المزيد من المنتجات
                    </button>
                </div>
            </div>
        </div>
    </section>

    <x-customer::components.client.newsletter />
    <x-customer::components.client.product-quick-view-modal :initial-product="$products[0]" />

    @push('styles')
        <style>
            [data-quick-view-modal].is-open { display: block; pointer-events: auto; }
            [data-quick-view-modal].is-open [data-quick-view-overlay] { opacity: 1; }
            [data-quick-view-modal].is-open [data-quick-view-panel] { opacity: 1; transform: translateY(0); }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const body = document.body;
                const modal = document.querySelector('[data-quick-view-modal]');
                const productUrlTemplate = @json(route('customer.products.show', '__slug__'));

                if (!modal) {
                    return;
                }

                const overlay = modal.querySelector('[data-quick-view-overlay]');
                const closeButtons = modal.querySelectorAll('[data-quick-view-close]');
                const triggers = document.querySelectorAll('[data-quick-view-target]');
                const setText = (selector, value) => {
                    const element = modal.querySelector(selector);
                    if (element) {
                        element.textContent = value ?? '';
                    }
                };
                const renderList = (selector, values, activeValue) => {
                    const container = modal.querySelector(selector);

                    if (!container) {
                        return;
                    }

                    container.innerHTML = '';

                    values.forEach((value) => {
                        const item = document.createElement('span');
                        item.className = 'flex min-w-16 items-center justify-center border border-gray-200 px-3 py-2 text-[10px] font-bold dark:border-gray-700';

                        if (value === activeValue) {
                            item.className += ' border-primary bg-primary text-white';
                        }

                        item.textContent = value;
                        container.appendChild(item);
                    });
                };

                const closeModal = () => {
                    modal.classList.remove('is-open');
                    modal.setAttribute('aria-hidden', 'true');
                    body.classList.remove('drawer-open');
                };

                const openModal = (product) => {
                    modal.classList.add('is-open');
                    modal.setAttribute('aria-hidden', 'false');
                    body.classList.add('drawer-open');

                    modal.querySelector('[data-quick-view-image]').src = product.main_image;
                    modal.querySelector('[data-quick-view-image]').alt = product.name;
                    setText('[data-quick-view-badge]', product.badge || 'منتج مميز');
                    setText('[data-quick-view-subtitle]', product.subtitle);
                    setText('[data-quick-view-name]', product.name);
                    setText('[data-quick-view-price]', product.formatted_price);
                    setText('[data-quick-view-old-price]', product.formatted_old_price || '');
                    setText('[data-quick-view-description]', product.description);
                    modal.querySelector('[data-quick-view-link]').href = productUrlTemplate.replace('__slug__', product.slug);

                    const thumbs = modal.querySelectorAll('[data-quick-view-thumb]');
                    thumbs.forEach((thumb, index) => {
                        thumb.src = product.gallery[index] || product.main_image;
                    });

                    renderList('[data-quick-view-colors]', product.colors || [], product.colors?.[0]);
                    renderList('[data-quick-view-sizes]', product.sizes || [], product.selected_size);
                };

                triggers.forEach((trigger) => {
                    trigger.addEventListener('click', (event) => {
                        if (event.target.closest('[data-ignore-quick-view]')) {
                            return;
                        }

                        const product = trigger.dataset.product ? JSON.parse(trigger.dataset.product) : null;

                        if (!product) {
                            return;
                        }

                        openModal(product);
                    });
                });

                overlay?.addEventListener('click', closeModal);
                closeButtons.forEach((button) => button.addEventListener('click', closeModal));

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape') {
                        closeModal();
                    }
                });
            });
        </script>
    @endpush
</x-customer::layouts.client>
