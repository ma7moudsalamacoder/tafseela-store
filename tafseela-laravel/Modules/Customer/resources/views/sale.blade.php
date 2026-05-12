<x-layout.client title="Tafsela | تفصيلة - التخفيضات" :cartCount="$cartCount ?? 2" :wishlistCount="$wishlistCount ?? 0">
    <div class="font-body text-neutral-charcoal antialiased">
        <main class="min-h-screen bg-background-light dark:bg-background-dark pt-8">
            <div class="container mx-auto px-4 lg:px-12">
                <!-- Breadcrumbs -->
                <nav class="flex justify-end mb-8 text-[11px] font-bold uppercase tracking-widest text-gray-400">
                    <ul class="flex items-center gap-3">
                        <li><a class="hover:text-primary transition-colors" href="{{ route('home') }}">الرئيسية</a></li>
                        <li class="flex items-center gap-2"><span
                                class="material-symbols-outlined text-sm">chevron_left</span> <a
                                class="hover:text-primary transition-colors"
                                href="{{ route('sale') }}">التخفيضات</a></li>
                    </ul>
                </nav>

                <div class="flex flex-col sm:lg:flex-row lg:flex-row gap-12 mb-40">
                    <!-- Aside Panel (Filters) -->
                    <aside class="w-full lg:w-72 flex-shrink-0">
                        <form id="filter-form" method="GET" action="" class="space-y-10 pb-40">
                            <input type="hidden" name="sort_by" value="{{ request()->query('sort_by') }}">
                            @if (request()->query('categoryId'))
                                <input type="hidden" name="categoryId"
                                    value="{{ request()->query('categoryId') }}">
                            @endif
                            @if (request()->query('subcategoryId'))
                                <input type="hidden" name="subcategoryId"
                                    value="{{ request()->query('subcategoryId') }}">
                            @endif

                            <!-- list of categories -->
                            <div>
                                <h5
                                    class="text-sm font-extrabold uppercase tracking-[0.2em] mb-6 border-r-4 border-[#8B5E3C] pr-4">
                                    التصنيفات</h5>
                                <ul class="space-y-4 text-xs font-bold text-gray-600 dark:text-gray-400">
                                    @foreach ($activeCategories as $activeCategory)
                                        <li>
                                            <a class="hover:text-[#8B5E3C] flex justify-between items-center transition-colors {{ $categoryId == $activeCategory->id ? 'text-[#8B5E3C]' : '' }}"
                                                href="{{ route('sale') }}?{{ http_build_query(array_merge(request()->except(['categoryId', 'subcategoryId', 'page']), ['categoryId' => $activeCategory->id])) }}">
                                                <span>{{ $activeCategory->category }}</span>
                                                <span
                                                    class="font-sans text-[10px] {{ $categoryId == $activeCategory->id ? '' : 'text-gray-300' }}">({{ $activeCategory->products_count }})</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- list of subcategories -->
                            <div>
                                <h5
                                    class="text-sm font-extrabold uppercase tracking-[0.2em] mb-6 border-r-4 border-[#8B5E3C] pr-4">
                                    الفئات الفرعية</h5>
                                <ul class="space-y-4 text-xs font-bold text-gray-600 dark:text-gray-400">
                                    @foreach ($subcategories as $subcategory)
                                        <li>
                                            <a class="hover:text-[#8B5E3C] flex justify-between items-center transition-colors {{ $subcategoryId == $subcategory->id ? 'text-[#8B5E3C]' : '' }}"
                                                href="{{ route('sale') }}?{{ http_build_query(array_merge(request()->except(['subcategoryId', 'page']), ['subcategoryId' => $subcategory->id])) }}">
                                                <span>{{ $subcategory->title }}</span>
                                                <span
                                                    class="font-sans text-[10px] {{ $subcategoryId == $subcategory->id ? '' : 'text-gray-300' }}">({{ $subcategory->products_count }})</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div>
                                <h5
                                    class="text-sm font-extrabold uppercase tracking-[0.2em] mb-6 border-r-4 border-[#8B5E3C] pr-4">
                                    نطاق السعر</h5>
                                <div class="px-2">
                                    <input id="min_price_range" name="min_price"
                                        class="w-full accent-[#8B5E3C] h-1 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                                        type="range" min="0" max="5000" value="{{ $min_price ?? 0 }}"
                                        onchange="document.getElementById('min_price_display').innerText = this.value + ' ج.م'; this.form.submit()" />
                                    <input id="max_price_range" name="max_price"
                                        class="w-full accent-[#8B5E3C] h-1 bg-gray-200 rounded-lg appearance-none cursor-pointer mt-2"
                                        type="range" min="0" max="5000" value="{{ $max_price ?? 5000 }}"
                                        onchange="document.getElementById('max_price_display').innerText = this.value + ' ج.م'; this.form.submit()" />
                                    <div class="flex justify-between mt-4 text-[10px] font-bold text-gray-500">
                                        <span id="min_price_display">{{ $min_price ?? 0 }} ج.م</span>
                                        <span id="max_price_display">{{ $max_price ?? 5000 }} ج.م</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h5
                                    class="text-sm font-extrabold uppercase tracking-[0.2em] mb-6 border-r-4 border-[#8B5E3C] pr-4">
                                    اللون</h5>
                                <div class="flex flex-wrap gap-3">
                                    <button type="submit" name="color" value="neutral-charcoal"
                                        class="w-8 h-8 rounded-full border border-gray-100 bg-neutral-charcoal focus:ring-2 focus:ring-offset-2 focus:ring-[#8B5E3C] {{ $color == 'neutral-charcoal' ? 'ring-2 ring-offset-2 ring-[#8B5E3C]' : '' }}"></button>
                                    <button type="submit" name="color" value="white"
                                        class="w-8 h-8 rounded-full border border-gray-100 bg-white focus:ring-2 focus:ring-offset-2 focus:ring-[#8B5E3C] {{ $color == 'white' ? 'ring-2 ring-offset-2 ring-[#8B5E3C]' : '' }}"></button>
                                    <button type="submit" name="color" value="blue-900"
                                        class="w-8 h-8 rounded-full border border-gray-100 bg-blue-900 focus:ring-2 focus:ring-offset-2 focus:ring-[#8B5E3C] {{ $color == 'blue-900' ? 'ring-2 ring-offset-2 ring-[#8B5E3C]' : '' }}"></button>
                                    <button type="submit" name="color" value="8B5E3C"
                                        class="w-8 h-8 rounded-full border border-gray-100 bg-[#8B5E3C] focus:ring-2 focus:ring-offset-2 focus:ring-[#8B5E3C] {{ $color == '8B5E3C' ? 'ring-2 ring-offset-2 ring-[#8B5E3C]' : '' }}"></button>
                                    <button type="submit" name="color" value="red-800"
                                        class="w-8 h-8 rounded-full border border-gray-100 bg-red-800 focus:ring-2 focus:ring-offset-2 focus:ring-[#8B5E3C] {{ $color == 'red-800' ? 'ring-2 ring-offset-2 ring-[#8B5E3C]' : '' }}"></button>
                                </div>
                            </div>
                            <div>
                                <h5
                                    class="text-sm font-extrabold uppercase tracking-[0.2em] mb-6 border-r-4 border-[#8B5E3C] pr-4">
                                    المقاس</h5>
                                <div class="grid grid-cols-4 gap-2">
                                    <button type="submit" name="size" value="S"
                                        class="border border-gray-200 dark:border-gray-700 py-2 text-[10px] font-bold hover:border-[#8B5E3C] hover:text-[#8B5E3C] transition-all {{ $size == 'S' ? 'border-[#8B5E3C] bg-[#8B5E3C] text-white' : '' }}">S</button>
                                    <button type="submit" name="size" value="M"
                                        class="border border-gray-200 dark:border-gray-700 py-2 text-[10px] font-bold hover:border-[#8B5E3C] hover:text-[#8B5E3C] transition-all {{ $size == 'M' ? 'border-[#8B5E3C] bg-[#8B5E3C] text-white' : '' }}">M</button>
                                    <button type="submit" name="size" value="L"
                                        class="border border-gray-200 dark:border-gray-700 py-2 text-[10px] font-bold hover:border-[#8B5E3C] hover:text-[#8B5E3C] transition-all {{ $size == 'L' ? 'border-[#8B5E3C] bg-[#8B5E3C] text-white' : '' }}">L</button>
                                    <button type="submit" name="size" value="XL"
                                        class="border border-gray-200 dark:border-gray-700 py-2 text-[10px] font-bold hover:border-[#8B5E3C] hover:text-[#8B5E3C] transition-all {{ $size == 'XL' ? 'border-[#8B5E3C] bg-[#8B5E3C] text-white' : '' }}">XL</button>
                                </div>
                            </div>

                            <!-- Reset Filters -->
                            <div class="pt-6">
                                <a href="{{ route('sale') }}"
                                    class="flex items-center justify-center gap-2 w-full py-4 border border-gray-200 text-[11px] font-extrabold uppercase tracking-widest hover:bg-neutral-charcoal hover:text-white transition-all">
                                    <span class="material-symbols-outlined text-sm">restart_alt</span>
                                    إعادة ضبط الفلاتر
                                </a>
                            </div>
                        </form>
                    </aside>

                    <!-- Main Content (Products) -->
                    <div class="flex-grow">
                        <div
                            class="flex items-center justify-between mb-10 pb-6 border-b border-gray-100 dark:border-gray-800">
                            <h2 class="text-2xl font-extrabold font-display tracking-tight">
                                التخفيضات <span
                                    class="text-gray-300 font-light text-sm mr-4">({{ $totalProducts }}
                                    منتج)</span></h2>
                            <div class="flex items-center gap-4">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">ترتيب
                                    حسب:</span>
                                <form id="sort-form" method="GET" action="">
                                    @if ($categoryId)
                                        <input type="hidden" name="categoryId" value="{{ $categoryId }}">
                                    @endif
                                    @if ($subcategoryId)
                                        <input type="hidden" name="subcategoryId"
                                            value="{{ $subcategoryId }}">
                                    @endif
                                    <select name="sort_by"
                                        class="border-none bg-transparent text-xs font-bold focus:ring-0 cursor-pointer"
                                        onchange="this.form.submit()">
                                        <option value="created_at" {{ $sort == 'created_at' ? 'selected' : '' }}>
                                            الأحدث</option>
                                        <option value="low_price" {{ $sort == 'low_price' ? 'selected' : '' }}>السعر:
                                            من الأقل للأعلى</option>
                                        <option value="high_price" {{ $sort == 'high_price' ? 'selected' : '' }}>
                                            السعر: من الأعلى للأقل</option>
                                    </select>
                                </form>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-x-8 gap-y-16">
                            @if ($formattedProducts->isEmpty())
                                <p class="text-center col-span-full text-gray-500">لا توجد منتجات لعرضها.</p>
                            @else
                                @foreach ($formattedProducts as $product)
                                    <x-customer::category-product-card :product="$product" />
                                @endforeach
                            @endif
                        </div>

                        <!-- Pagination -->
                        @if ($productsPaginator->hasPages())
                            <div class="mt-20 flex justify-center items-center gap-4">
                                {{ $productsPaginator->links('customer::components.pagination') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>

    </div>
</x-layout.client>
