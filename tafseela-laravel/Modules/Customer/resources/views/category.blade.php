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
                            <!-- Product Grid Items Ported Directly -->
                            <div class="group product-card-shadow">
                                <div class="relative aspect-[4/5] overflow-hidden bg-gray-50 mb-6">
                                    <img alt="Premium Linen Shirt" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAa8rxsCtnHO1uoqPKohyj3olgrRNYd84CD7ibbTxlOhJunn23RMdUvhV50rilc6g5xsGQ_Bz3Y6_Xi3llenb_loo06rLbJj2A5MY-DoJt46VO0LHC-q4_C_TuacMR1u3F4JMj1Ljr3TR_Js_TN_DGjG6a96fJulUh_UttCtpU5wRgwu7HoF0JwqHBOu_Qz_pKne5ROiSCvA5oWyansb_9tY7WE5Mz3MOeEqJBIlamFRHh5OYXaonC9MQawVhOYhPZoq8Au59PQYaLn"/>
                                    <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <div class="absolute bottom-4 left-4 right-4 translate-y-10 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-500 flex gap-2">
                                        <button class="flex-grow bg-white text-neutral-charcoal hover:bg-[#8B5E3C] hover:text-white py-4 text-[10px] font-bold uppercase tracking-widest transition-colors flex items-center justify-center gap-2">
                                            <span class="material-symbols-outlined text-base">shopping_bag</span>
                                            إضافة سريعة
                                        </button>
                                        <button class="bg-white text-neutral-charcoal hover:text-red-500 w-12 flex items-center justify-center transition-colors">
                                            <span class="material-symbols-outlined">favorite</span>
                                        </button>
                                    </div>
                                    <span class="absolute top-4 right-4 bg-[#8B5E3C] text-white text-[9px] font-extrabold px-3 py-1 tracking-widest">وصل حديثاً</span>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="font-bold text-base hover:text-[#8B5E3C] transition-colors cursor-pointer tracking-tight font-display">قميص كتان فاخر</h4>
                                    <p class="text-gray-400 text-[9px] font-bold uppercase tracking-widest">أزرق سماوي - صيفي</p>
                                    <div class="flex items-center gap-3 pt-2">
                                        <span class="font-bold text-lg text-[#8B5E3C]">1,250 ج.م</span>
                                    </div>
                                </div>
                            </div>

                            <div class="group product-card-shadow">
                                <div class="relative aspect-[4/5] overflow-hidden bg-gray-50 mb-6">
                                    <img alt="Classic Cotton Shirt" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAtKicfpnDGxV6OZ2AcKbavKPy2wiKTHJpXSR_qEVlqnyuzIWeOETtGbC1_xTCE3wiEs37Je1VvyoWrDgJlz4-W0sOonxdwLSRtNxXrYspmmROYfEJ9Bgx31eWI7Aha_atd1OG0Q6EAEIuvh7oHir9DLMvuPUNLiVe2XwNwWYuAOtONslDp2u_F7V9pMFNeviQfyvM92F3CZlvlpUvctZJLIOB_tmP_EKmLrmB26IrTo3Lm4KX8ty7bDv3v09A3LtqGyo_7BJUoin53"/>
                                    <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <div class="absolute bottom-4 left-4 right-4 translate-y-10 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-500 flex gap-2">
                                        <button class="flex-grow bg-white text-neutral-charcoal hover:bg-[#8B5E3C] hover:text-white py-4 text-[10px] font-bold uppercase tracking-widest transition-colors flex items-center justify-center gap-2">
                                            <span class="material-symbols-outlined text-base">shopping_bag</span>
                                            إضافة سريعة
                                        </button>
                                        <button class="bg-white text-neutral-charcoal hover:text-red-500 w-12 flex items-center justify-center transition-colors">
                                            <span class="material-symbols-outlined">favorite</span>
                                        </button>
                                    </div>
                                    <span class="absolute top-4 right-4 bg-[#8B5E3C] text-white text-[9px] font-extrabold px-3 py-1 tracking-widest">خصم 15%</span>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="font-bold text-base hover:text-[#8B5E3C] transition-colors cursor-pointer tracking-tight font-display">قميص قطن كلاسيكي</h4>
                                    <p class="text-gray-400 text-[9px] font-bold uppercase tracking-widest">أبيض ملكي - رسمي</p>
                                    <div class="flex items-center gap-3 pt-2">
                                        <span class="font-bold text-lg text-[#8B5E3C]">950 ج.م</span>
                                        <span class="text-sm text-gray-300 line-through">1,120 ج.م</span>
                                    </div>
                                </div>
                            </div>

                            <div class="group product-card-shadow">
                                <div class="relative aspect-[4/5] overflow-hidden bg-gray-50 mb-6">
                                    <img alt="Modern Striped Shirt" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAbi3E7Kulf-O39skm-_q21SAHf1y-hZ4ToIZmrNSJz5N7tKArej1WXHzgD2l1Jvtm7wor_gDh9NC2j0ZAMXdV1bCjcvYAqXP_xWrT6PSJYaKk9-1PdFQopPgmBmBFgWDA5_sJ3Vnxzp9IkrlliKv5tQZjFVT3j-_BoV5Y9Ij4sr1ctB3EuNxssOGOTkdmFQ8tWUJ1V3wJAXvqDNNnN-M_9wCPr9ClSqkeODujbxIdxwFE12bb2qCRHl3mp8xOFHnrxg00RkrqoykTB"/>
                                    <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <div class="absolute bottom-4 left-4 right-4 translate-y-10 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-500 flex gap-2">
                                        <button class="flex-grow bg-white text-neutral-charcoal hover:bg-[#8B5E3C] hover:text-white py-4 text-[10px] font-bold uppercase tracking-widest transition-colors flex items-center justify-center gap-2">
                                            <span class="material-symbols-outlined text-base">shopping_bag</span>
                                            إضافة سريعة
                                        </button>
                                        <button class="bg-white text-neutral-charcoal hover:text-red-500 w-12 flex items-center justify-center transition-colors">
                                            <span class="material-symbols-outlined">favorite</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="font-bold text-base hover:text-[#8B5E3C] transition-colors cursor-pointer tracking-tight font-display">قميص مخطط عصري</h4>
                                    <p class="text-gray-400 text-[9px] font-bold uppercase tracking-widest">كحلي ورمادي - كاجوال</p>
                                    <div class="flex items-center gap-3 pt-2">
                                        <span class="font-bold text-lg text-[#8B5E3C]">1,100 ج.م</span>
                                    </div>
                                </div>
                            </div>

                            <div class="group product-card-shadow">
                                <div class="relative aspect-[4/5] overflow-hidden bg-gray-50 mb-6">
                                    <img alt="Oxford Shirt" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDfMNJWS58aYPNNEez7zZBK5oYciY9gRf1GmsCiGl5SzDQjlijSF7npj2Mt4NvlkEPwpwhWpFmI7xkaz5-A16AUn3QOJq0vdNIyeOmDH8gyNS5jxRDEjW4aYPqGjFzkGzpH_TVCvOzCXirQkdZh9p42PP65T5aKazbGhn-0H8vn4zOGs6qOHiF7ASAXUd22n5J9ViCrJgx0ASgEWABTEchYdsy1T8PuXZjOWvjQJcpXXRLC7J7EyBtUkgOKd7YQ_qoisaPjpRaZMtSu"/>
                                    <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <div class="absolute bottom-4 left-4 right-4 translate-y-10 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-500 flex gap-2">
                                        <button class="flex-grow bg-white text-neutral-charcoal hover:bg-[#8B5E3C] hover:text-white py-4 text-[10px] font-bold uppercase tracking-widest transition-colors flex items-center justify-center gap-2">
                                            إضافة سريعة
                                        </button>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="font-bold text-base font-display">قميص أكسفورد ناعم</h4>
                                    <p class="text-gray-400 text-[9px] font-bold uppercase tracking-widest">رمادي هادئ</p>
                                    <div class="flex items-center gap-3 pt-2">
                                        <span class="font-bold text-lg text-[#8B5E3C]">890 ج.م</span>
                                    </div>
                                </div>
                            </div>
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
