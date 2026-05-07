<x-layout.client title="Tafsela | تفصيلة - المنتجات" :cartCount="$cartCount ?? 2" :wishlistCount="$wishlistCount ?? 0">
    <div class="font-body text-neutral-charcoal antialiased">
        <main class="min-h-screen bg-background-light dark:bg-background-dark pt-8">
            <div class="container mx-auto px-4 lg:px-12">
                <!-- Breadcrumbs -->
                <nav class="flex justify-end mb-8 text-[11px] font-bold uppercase tracking-widest text-gray-400">
                    <ul class="flex items-center gap-3">
                        <li><a class="hover:text-primary transition-colors" href="#">الرئيسية</a></li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">chevron_left</span> <a class="hover:text-primary transition-colors" href="#">أزياء</a></li>
                        <li class="flex items-center gap-2 text-[#8B5E3C]"><span class="material-symbols-outlined text-sm">chevron_left</span> ملابس رجالي</li>
                    </ul>
                </nav>

                <div class="flex flex-col sm:lg:flex-row lg:flex-row gap-12">
                    <!-- Aside Panel (Filters) - Must be first for RTL Right Alignment -->
                    <aside class="w-full lg:w-72 flex-shrink-0 space-y-10">
                        <div>
                            <h5 class="text-sm font-extrabold uppercase tracking-[0.2em] mb-6 border-r-4 border-[#8B5E3C] pr-4">الفئات</h5>
                            <ul class="space-y-4 text-xs font-bold text-gray-600 dark:text-gray-400">
                                <li><a class="hover:text-[#8B5E3C] flex justify-between items-center transition-colors" href="#"><span>تيشيرتات</span><span class="font-sans text-[10px] text-gray-300">(120)</span></a></li>
                                <li><a class="hover:text-[#8B5E3C] flex justify-between items-center transition-colors text-[#8B5E3C]" href="#"><span>قمصان</span><span class="font-sans text-[10px]">(85)</span></a></li>
                                <li><a class="hover:text-[#8B5E3C] flex justify-between items-center transition-colors" href="#"><span>بناطيل</span><span class="font-sans text-[10px] text-gray-300">(64)</span></a></li>
                                <li><a class="hover:text-[#8B5E3C] flex justify-between items-center transition-colors" href="#"><span>جواكت</span><span class="font-sans text-[10px] text-gray-300">(42)</span></a></li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="text-sm font-extrabold uppercase tracking-[0.2em] mb-6 border-r-4 border-[#8B5E3C] pr-4">نطاق السعر</h5>
                            <div class="px-2">
                                <input class="w-full accent-[#8B5E3C] h-1 bg-gray-200 rounded-lg appearance-none cursor-pointer" max="5000" min="0" type="range"/>
                                <div class="flex justify-between mt-4 text-[10px] font-bold text-gray-500">
                                    <span>0 ج.م</span>
                                    <span>5000 ج.م</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h5 class="text-sm font-extrabold uppercase tracking-[0.2em] mb-6 border-r-4 border-[#8B5E3C] pr-4">اللون</h5>
                            <div class="flex flex-wrap gap-3">
                                <button class="w-8 h-8 rounded-full border border-gray-100 bg-neutral-charcoal focus:ring-2 focus:ring-offset-2 focus:ring-[#8B5E3C]"></button>
                                <button class="w-8 h-8 rounded-full border border-gray-100 bg-white focus:ring-2 focus:ring-offset-2 focus:ring-[#8B5E3C]"></button>
                                <button class="w-8 h-8 rounded-full border border-gray-100 bg-blue-900 focus:ring-2 focus:ring-offset-2 focus:ring-[#8B5E3C]"></button>
                                <button class="w-8 h-8 rounded-full border border-gray-100 bg-[#8B5E3C] focus:ring-2 focus:ring-offset-2 focus:ring-[#8B5E3C]"></button>
                                <button class="w-8 h-8 rounded-full border border-gray-100 bg-red-800 focus:ring-2 focus:ring-offset-2 focus:ring-[#8B5E3C]"></button>
                            </div>
                        </div>
                        <div>
                            <h5 class="text-sm font-extrabold uppercase tracking-[0.2em] mb-6 border-r-4 border-[#8B5E3C] pr-4">المقاس</h5>
                            <div class="grid grid-cols-4 gap-2">
                                <button class="border border-gray-200 dark:border-gray-700 py-2 text-[10px] font-bold hover:border-[#8B5E3C] hover:text-[#8B5E3C] transition-all">S</button>
                                <button class="border border-[#8B5E3C] bg-[#8B5E3C] text-white py-2 text-[10px] font-bold">M</button>
                                <button class="border border-gray-200 dark:border-gray-700 py-2 text-[10px] font-bold hover:border-[#8B5E3C] hover:text-[#8B5E3C] transition-all">L</button>
                                <button class="border border-gray-200 dark:border-gray-700 py-2 text-[10px] font-bold hover:border-[#8B5E3C] hover:text-[#8B5E3C] transition-all">XL</button>
                            </div>
                        </div>
                    </aside>

                    <!-- Main Content (Products) -->
                    <div class="flex-grow">
                        <div class="flex items-center justify-between mb-10 pb-6 border-b border-gray-100 dark:border-gray-800">
                            <h2 class="text-2xl font-extrabold font-display tracking-tight">قمصان رجالي <span class="text-gray-300 font-light text-sm mr-4">(85 منتج)</span></h2>
                            <div class="flex items-center gap-4">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">ترتيب حسب:</span>
                                <select class="border-none bg-transparent text-xs font-bold focus:ring-0 cursor-pointer">
                                    <option>الأحدث</option>
                                    <option>السعر: من الأقل للأعلى</option>
                                    <option>السعر: من الأعلى للأقل</option>
                                    <option>الأكثر مبيعاً</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-x-8 gap-y-16">
                            @foreach($products as $product)
                                @php
                                    $productData = [
                                        'name' => $product->name,
                                        'description' => $product->fabric ?? 'وصف المنتج',
                                        'image' => $product->image ?? 'https://via.placeholder.com/400x500',
                                        'price' => $product->price . ' ج.م',
                                        'badge' => null, // Add badge logic if available in your model
                                    ];
                                @endphp
                                <x-customer::category-product-card :product="$productData" />
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-20 flex justify-center items-center gap-4">
                            <button class="w-12 h-12 border border-gray-100 flex items-center justify-center hover:border-[#8B5E3C] hover:text-[#8B5E3C] transition-all">
                                <span class="material-symbols-outlined">chevron_right</span>
                            </button>
                            <div class="flex gap-2">
                                <button class="w-12 h-12 bg-[#8B5E3C] text-white font-bold text-xs">1</button>
                                <button class="w-12 h-12 border border-gray-100 font-bold text-xs hover:border-[#8B5E3C] hover:text-[#8B5E3C] transition-all">2</button>
                                <button class="w-12 h-12 border border-gray-100 font-bold text-xs hover:border-[#8B5E3C] hover:text-[#8B5E3C] transition-all">3</button>
                            </div>
                            <button class="w-12 h-12 border border-gray-100 flex items-center justify-center hover:border-[#8B5E3C] hover:text-[#8B5E3C] transition-all">
                                <span class="material-symbols-outlined">chevron_left</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>
</x-layout.client>
