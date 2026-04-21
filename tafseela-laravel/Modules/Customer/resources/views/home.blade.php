<x-customer::layouts.client title="الرئيسية - تفصيلة" description="متجر تفصيلة للأزياء العصرية والفاخرة في مصر">
    
    <x-customer::components.client.hero-banner />
    
    {{-- Categories Section --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4 lg:px-12">
            <div class="text-center mb-16">
                <span class="text-[11px] font-bold uppercase tracking-[0.3em] text-primary mb-4 block">تسوق حسب</span>
                <h2 class="text-4xl lg:text-5xl font-extrabold text-neutral-charcoal tracking-tight">الفئات</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <a href="{{ route('customer.sections.show', 'mens-shirts') }}" class="group relative aspect-[3/4] overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1617137968427-85924c800a22?w=600&q=80" alt="رجالي" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8 text-right">
                        <h3 class="text-3xl font-extrabold text-white mb-2">رجالي</h3>
                        <span class="text-white/80 text-sm font-bold uppercase tracking-wider">تسوق الآن</span>
                    </div>
                </a>
                
                <a href="{{ route('customer.sections.show', 'womens-dresses') }}" class="group relative aspect-[3/4] overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=600&q=80" alt="نسائي" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8 text-right">
                        <h3 class="text-3xl font-extrabold text-white mb-2">نسائي</h3>
                        <span class="text-white/80 text-sm font-bold uppercase tracking-wider">تسوق الآن</span>
                    </div>
                </a>
                
                <a href="{{ route('customer.products.index') }}" class="group relative aspect-[3/4] overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1503919545889-aef636e10ad4?w=600&q=80" alt="أطفال" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8 text-right">
                        <h3 class="text-3xl font-extrabold text-white mb-2">أطفال</h3>
                        <span class="text-white/80 text-sm font-bold uppercase tracking-wider">تسوق الآن</span>
                    </div>
                </a>
            </div>
        </div>
    </section>
    
    {{-- New Arrivals --}}
    <section class="py-24 bg-neutral-beige">
        <div class="container mx-auto px-4 lg:px-12">
            <div class="flex items-end justify-between mb-16">
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-[0.3em] text-primary mb-4 block">الجديد</span>
                    <h2 class="text-4xl lg:text-5xl font-extrabold text-neutral-charcoal tracking-tight">وصلنا حديثاً</h2>
                </div>
                <a href="{{ route('customer.products.index') }}" class="text-sm font-bold text-primary uppercase tracking-wider hover:text-primary-dark transition-colors">عرض الكل ←</a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <x-customer::components.client.product-card :product="['id' => 1, 'slug' => 'premium-linen-shirt', 'name' => 'قميص كتان أبيض', 'image' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=400', 'price' => 850, 'old_price' => null, 'category' => 'وصلنا حديثاً']" />
                <x-customer::components.client.product-card :product="['id' => 2, 'slug' => 'classic-chino-pants', 'name' => 'بنطلون جينز سليم', 'image' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=400', 'price' => 1200, 'old_price' => 1500, 'category' => 'وصلنا حديثاً']" />
                <x-customer::components.client.product-card :product="['id' => 3, 'slug' => 'silk-evening-dress', 'name' => 'فستان سهرة مخمل', 'image' => 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=400', 'price' => 2800, 'old_price' => null, 'category' => 'وصلنا حديثاً']" />
                <x-customer::components.client.product-card :product="['id' => 4, 'slug' => 'modern-jacket', 'name' => 'بدلة رسمية كاجوال', 'image' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=400', 'price' => 3500, 'old_price' => 4200, 'category' => 'وصلنا حديثاً']" />
            </div>
        </div>
    </section>
    
    {{-- Men's Formal --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="relative aspect-square lg:aspect-[4/5] overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=800&q=80" alt="رجالي رسمي" class="w-full h-full object-cover">
                </div>
                
                <div class="text-right lg:pr-12">
                    <span class="text-[11px] font-bold uppercase tracking-[0.3em] text-primary mb-4 block">مجموعة حصرية</span>
                    <h2 class="text-5xl lg:text-6xl font-extrabold text-neutral-charcoal tracking-tight mb-8">رجالي رسمي</h2>
                    <p class="text-lg text-gray-600 leading-relaxed mb-10">اكتشف مجموعة البدل الرسمية والأقمشة الفاخرة. تصاميم كلاسيكية عصرية تناسب جميع المناسبات.</p>
                    
                    <div class="flex flex-wrap gap-6 mb-12">
                        <div class="text-center"><span class="text-4xl font-extrabold text-primary">50+</span><p class="text-xs font-bold uppercase tracking-wider text-gray-500 mt-1">تصميم</p></div>
                        <div class="text-center"><span class="text-4xl font-extrabold text-primary">100%</span><p class="text-xs font-bold uppercase tracking-wider text-gray-500 mt-1">قطن فاخر</p></div>
                        <div class="text-center"><span class="text-4xl font-extrabold text-primary">4</span><p class="text-xs font-bold uppercase tracking-wider text-gray-500 mt-1">ألوان</p></div>
                    </div>
                    
                    <a href="{{ route('customer.sections.show', 'mens-shirts') }}" class="inline-block bg-primary text-white px-10 py-4 text-[12px] font-extrabold uppercase tracking-widest hover:bg-primary-dark transition-colors luxury-button-hover">تسوق الآن</a>
                </div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-16">
                <x-customer::components.client.product-card :product="['id' => 5, 'slug' => 'modern-jacket', 'name' => 'بدلة رسمية كلاسيكية', 'image' => 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=400', 'price' => 2450, 'old_price' => null, 'category' => 'رجالي - رسمي']" />
                <x-customer::components.client.product-card :product="['id' => 6, 'slug' => 'premium-linen-shirt', 'name' => 'قميص كتان أبيض', 'image' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=400', 'price' => 650, 'old_price' => 800, 'category' => 'رجالي - كتان']" />
                <x-customer::components.client.product-card :product="['id' => 7, 'slug' => 'natural-leather-shoes', 'name' => 'ربطة عنق حرير', 'image' => 'https://images.unsplash.com/photo-1598522325074-042db73aa4e6?w=400', 'price' => 350, 'old_price' => null, 'category' => 'إكسسوارات']" />
                <x-customer::components.client.product-card :product="['id' => 8, 'slug' => 'classic-chino-pants', 'name' => 'بدلة كاجوال', 'image' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=400', 'price' => 1950, 'old_price' => 2200, 'category' => 'رجالي - كاجوال']" />
            </div>
        </div>
    </section>
    
    <x-customer::components.client.newsletter />
    
</x-customer::layouts.client>
