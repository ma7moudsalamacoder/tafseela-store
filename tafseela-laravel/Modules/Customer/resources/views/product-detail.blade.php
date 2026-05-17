<x-layout.client title="Tafsela | تفصيلة - {{ $productData['name'] }}" :cartCount="$cartCount ?? 2" :wishlistCount="$wishlistCount ?? 0">
    <main class="min-h-screen bg-background-light dark:bg-background-dark">
        <section class="py-12 lg:py-20 container mx-auto px-4 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                <div class="lg:col-span-7 order-1 lg:order-2">
                    <div class="relative aspect-[4/5] overflow-hidden bg-gray-100">
                        <img id="main-product-image" alt="{{ $productData['name'] }}" class="w-full h-full object-cover" src="{{ $productData['image'] }}" />

                        @if ($productData['badge'])
                            <span class="absolute top-4 right-4 bg-[#8B5E3C] text-white text-[9px] font-extrabold px-3 py-1 tracking-widest">{{ $productData['badge'] }}</span>
                        @endif
                    </div>
                </div>
                <div class="lg:col-span-5 order-2 lg:order-1 flex flex-col">
                    <div class="mb-10">
                        <nav class="flex text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-6 gap-2">
                            <a class="hover:text-primary transition-colors" href="{{ route('home') }}">الرئيسية</a>
                            @if ($productData['category'])
                                <span>/</span>
                                <a class="hover:text-primary transition-colors" href="{{ $productData['category_slug'] ? route('category', $productData['category_slug']) : '#' }}">{{ $productData['category'] }}</a>
                            @endif
                            <span>/</span>
                            <span class="text-neutral-charcoal dark:text-white">{{ $productData['name'] }}</span>
                        </nav>
                        <h2 class="text-4xl lg:text-5xl font-extrabold mb-4 text-neutral-charcoal dark:text-white">{{ $productData['name'] }}</h2>
                        <div class="flex items-center gap-6 mb-8">
                            <span class="text-3xl font-extrabold text-primary">{{ $productData['price'] }}</span>
                            @if ($productData['old_price'])
                                <span class="text-lg text-gray-400 line-through">{{ $productData['old_price'] }}</span>
                            @endif
                            @if ($productData['badge'])
                                <span class="bg-primary text-white text-[10px] font-extrabold px-3 py-1 tracking-widest">{{ $productData['badge'] }}</span>
                            @endif
                        </div>
                        @if ($productData['description'])
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-3 text-lg">
                                {{ $productData['description'] }}
                            </p>
                        @endif
                        @if ($productData['fabric'])
                            <p class="text-gray-500 dark:text-gray-500 text-sm font-bold">
                                <span class="text-primary">القماش:</span> {{ $productData['fabric'] }}
                            </p>
                        @endif
                        <p class="text-gray-500 dark:text-gray-500 text-sm font-bold mt-2">
                            <span class="text-primary">المخزون:</span> <span id="stock-count">{{ $productData['details']->sum('stock_qty') }}</span> قطعة متاحة
                        </p>
                    </div>
                    <div class="space-y-10 mb-12">
                        @php
                            $uniqueColors = $productData['details']->pluck('color')->unique()->filter();
                            $allSizes = $productData['details']->pluck('size')->unique()->filter();
                        @endphp

                        @if ($uniqueColors->isNotEmpty())
                            <div>
                                <div class="flex justify-between items-center mb-5">
                                    <span class="font-bold text-xs uppercase tracking-widest">اختر اللون</span>
                                </div>
                                <div class="flex flex-wrap gap-3">
                                    @foreach ($uniqueColors as $color)
                                        <button type="button" onclick="selectColor(this, '{{ $color }}')" class="color-btn w-8 h-8 rounded-full border border-gray-100 focus:ring-2 focus:ring-offset-2 focus:ring-[#8B5E3C] transition-all" style="background-color: {{ $color }};" data-color="{{ $color }}"></button>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div>
                            <div class="flex justify-between items-center mb-5">
                                <span class="font-bold text-xs uppercase tracking-widest">اختر المقاس</span>
                                <a class="text-primary text-[10px] font-extrabold underline underline-offset-4 uppercase tracking-widest" href="#">دليل المقاسات</a>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($allSizes as $size)
                                    <button type="button" onclick="selectSize(this, '{{ $size }}')" class="size-btn w-14 h-14 border border-gray-200 dark:border-gray-700 flex items-center justify-center font-bold text-sm hover:border-primary hover:text-primary transition-all" data-size="{{ $size }}">{{ $size }}</button>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex flex-col gap-4">
                            <button type="button" onclick="addToCart({{ $productData['id'] }}, this, selectedDetailId)" class="w-full bg-primary text-white py-6 font-extrabold text-sm uppercase tracking-[0.2em] luxury-button-hover hover:bg-primary-dark shadow-xl shadow-primary/20 flex items-center justify-center gap-4">
                                <span class="btn-text">إضافة إلى السلة</span>
                                <span class="material-symbols-outlined">shopping_bag</span>
                            </button>
                            <button type="button" onclick="toggleWishlist({{ $productData['id'] }}, this)" class="w-full border-2 border-neutral-charcoal/10 dark:border-white/20 py-6 font-extrabold text-sm uppercase tracking-[0.2em] luxury-button-hover hover:bg-neutral-charcoal hover:text-white flex items-center justify-center gap-4">
                                حفظ في المفضلة
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ $isInWishlist ? 1 : 0 }}">favorite</span>
                            </button>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-800">
                        <details class="group border-b border-gray-100 dark:border-gray-800">
                            <summary class="flex justify-between items-center py-6 cursor-pointer group-open:pb-4 transition-all">
                                <span class="font-extrabold text-xs uppercase tracking-widest">معلومات الشحن والإرجاع</span>
                                <span class="material-symbols-outlined text-gray-400 group-open:rotate-180 transition-transform">expand_more</span>
                            </summary>
                            <div class="pb-8 text-sm text-gray-600 dark:text-gray-400 space-y-3">
                                <p>• التوصيل المجاني خلال 3-5 أيام عمل للطلبات فوق 500 جنيه.</p>
                                <p>• إمكانية الإرجاع خلال 14 يوماً من تاريخ الاستلام.</p>
                                <p>• رسوم شحن ثابتة 50 جنيهاً للطلبات الأقل من 500 جنيه.</p>
                            </div>
                        </details>
                    </div>
                </div>
            </div>
        </section>

        @if ($relatedProducts->isNotEmpty())
            <section class="py-24 bg-white dark:bg-gray-900/10">
                <div class="container mx-auto px-4 lg:px-12">
                    <div class="flex justify-between items-end mb-12">
                        <div class="space-y-3">
                            <span class="text-primary font-bold text-[10px] tracking-[0.3em] uppercase">المزيد لتكتشفه</span>
                            <h3 class="text-4xl font-extrabold">منتجات قد تعجبك</h3>
                        </div>
                        <div class="flex gap-4">
                            <button onclick="document.querySelector('.related-scroll').scrollBy({left: 400, behavior: 'smooth'})" class="w-12 h-12 border border-neutral-charcoal/10 flex items-center justify-center hover:border-primary transition-colors">
                                <span class="material-symbols-outlined rotate-180">arrow_back</span>
                            </button>
                            <button onclick="document.querySelector('.related-scroll').scrollBy({left: -400, behavior: 'smooth'})" class="w-12 h-12 border border-neutral-charcoal/10 flex items-center justify-center hover:border-primary transition-colors">
                                <span class="material-symbols-outlined">arrow_back</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex overflow-x-auto gap-8 hide-scrollbar pb-12 snap-x related-scroll">
                        @foreach ($relatedProducts as $related)
                            <div class="min-w-[280px] lg:min-w-[320px] group snap-start product-card-shadow">
                                <div class="relative aspect-[4/5] overflow-hidden bg-gray-50 mb-6">
                                    <a href="{{ route('product-detail', $related['id']) }}">
                                        <img alt="{{ $related['name'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $related['image'] }}" />
                                    </a>
                                    <button type="button" onclick="addToCart({{ $related['id'] }}, this, {{ $related['default_product_detail_id'] ?: 'null' }})" class="absolute bottom-0 left-0 right-0 bg-primary text-white py-5 font-extrabold text-[11px] uppercase tracking-[0.2em] opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-full group-hover:translate-y-0 z-10">
                                        أضف إلى السلة
                                    </button>
                                    @if ($related['badge'])
                                        <span class="absolute top-6 right-6 bg-primary text-white text-[10px] font-extrabold px-4 py-1.5 tracking-widest shadow-lg">{{ $related['badge'] }}</span>
                                    @endif
                                </div>
                                <div class="px-2">
                                    <h4 class="font-bold text-lg mb-1 hover:text-primary transition-colors cursor-pointer tracking-tight">
                                        <a href="{{ route('product-detail', $related['id']) }}">{{ $related['name'] }}</a>
                                    </h4>
                                    <div class="flex items-center gap-4">
                                        <span class="font-bold text-xl text-primary">{{ $related['price'] }}</span>
                                        @if ($related['old_price'])
                                            <span class="text-sm text-gray-300 line-through">{{ $related['old_price'] }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </main>

    @php
        $detailsJson = json_encode($productData['details']->map(fn ($d) => [
            'id' => $d['id'],
            'color' => $d['color'],
            'size' => $d['size'],
            'cover_image' => $d['cover_image'],
            'stock_qty' => $d['stock_qty'],
        ])->values());
    @endphp

    <script>
        var productDetails = {!! $detailsJson !!};
        var defaultImage = '{{ $productData['image'] }}';
        var selectedColor = null;
        var selectedSize = null;
        var selectedDetailId = null;

        function selectColor(btn, color) {
            document.querySelectorAll('.color-btn').forEach(function(b) {
                b.classList.remove('ring-2', 'ring-offset-2', 'ring-[#8B5E3C]');
            });
            btn.classList.add('ring-2', 'ring-offset-2', 'ring-[#8B5E3C]');

            selectedColor = color;
            updateProductDisplay();
        }

        function selectSize(btn, size) {
            document.querySelectorAll('.size-btn').forEach(function(b) {
                b.classList.remove('border-primary', 'bg-[#8B5E3C]', 'text-white');
                b.classList.add('border-gray-200', 'dark:border-gray-700', 'hover:border-primary', 'hover:text-primary');
            });
            btn.classList.remove('border-gray-200', 'dark:border-gray-700', 'hover:border-primary', 'hover:text-primary');
            btn.classList.add('border-primary', 'bg-[#8B5E3C]', 'text-white');

            selectedSize = size;
            updateProductDisplay();
        }

        function findMatchingDetail() {
            if (!selectedColor && !selectedSize) return null;

            return productDetails.find(function(d) {
                if (selectedColor && d.color !== selectedColor) return false;
                if (selectedSize && d.size !== selectedSize) return false;
                return true;
            });
        }

        function updateProductDisplay() {
            var match = findMatchingDetail();
            var img = document.getElementById('main-product-image');

            if (match) {
                selectedDetailId = match.id;
                if (match.cover_image) {
                    img.src = match.cover_image;
                } else {
                    img.src = defaultImage;
                }
            } else {
                selectedDetailId = null;
                img.src = defaultImage;
            }

            updateStockDisplay();
        }

        function updateStockDisplay() {
            var filtered = productDetails.filter(function(d) {
                if (selectedColor && d.color !== selectedColor) return false;
                if (selectedSize && d.size !== selectedSize) return false;
                return true;
            });
            var total = filtered.reduce(function(sum, d) { return sum + d.stock_qty; }, 0);
            document.getElementById('stock-count').textContent = total;
        }

        if (productDetails.length > 0) {
            selectedDetailId = productDetails[0].id;
        }

        var firstColorBtn = document.querySelector('.color-btn');
        var firstSizeBtn = document.querySelector('.size-btn');
        if (firstColorBtn) firstColorBtn.click();
        if (firstSizeBtn) firstSizeBtn.click();
    </script>
</x-layout.client>
