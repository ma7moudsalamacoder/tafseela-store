<x-layout.client title="Tafsela | تفصيلة - الرئيسية" :cartCount="$cartCount ?? 2" :wishlistCount="$wishlistCount ?? 0">

    <section class="relative h-[85vh] min-h-[700px] bg-neutral-beige dark:bg-gray-950 overflow-hidden">
        <div class="absolute inset-0">
            <img alt="Modern elegant fashion photography featuring a model in contemporary premium apparel" class="w-full h-full object-cover object-center scale-105" src="{{ $hero['image'] }}" />
            <div class="absolute inset-0 bg-gradient-to-l from-white/95 via-white/40 to-transparent dark:from-background-dark/95 dark:via-background-dark/40"></div>
        </div>
        <div class="container mx-auto px-4 lg:px-12 h-full flex items-center relative z-10">
            <div class="max-w-2xl space-y-8">
                <span class="text-white font-extrabold tracking-[0.3em] uppercase text-[11px] inline-flex items-center gap-4 bg-primary py-1.5 px-6">
                    {{ $hero['badge'] }}
                </span>
                <h2 class="text-6xl lg:text-8xl font-extrabold leading-[1.1] text-neutral-charcoal dark:text-white">
                    الأناقة تبدأ <br />
                    <span class="bg-primary px-4 text-white">بتفصيلة</span> فريدة
                </h2>
                <p class="text-xl text-neutral-charcoal/80 dark:text-gray-300 max-w-md leading-relaxed font-medium">
                    {{ $hero['description'] }}
                </p>
                <div class="flex flex-wrap gap-5 pt-4">
                    <a href="{{ route('shop') }}" class="bg-primary text-white px-14 py-5 font-extrabold hover:bg-neutral-charcoal hover:text-white luxury-button-hover flex items-center gap-4 text-sm tracking-widest shadow-2xl shadow-primary/20">
                        تسوق الآن
                        <span class="material-symbols-outlined text-lg">arrow_back</span>
                    </a>
                    <a href="{{ route('collection', $hero['collectionSlug'] ?? 'latest') }}" class="bg-white/50 backdrop-blur-sm border-2 border-neutral-charcoal/10 dark:bg-transparent dark:border-white/30 px-14 py-5 font-bold hover:border-primary hover:text-primary transition-all text-sm tracking-widest">
                        رؤية المجموعة
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 lg:py-32 container mx-auto px-4 lg:px-12">
        <div class="flex flex-col items-center mb-16 text-center">
            <span class="text-primary font-bold text-[10px] tracking-[0.4em] uppercase mb-4">الأقسام المختارة</span>
            <h3 class="text-4xl font-extrabold mb-6 text-neutral-charcoal dark:text-white">تسوق حسب الفئة</h3>
            <div class="w-20 h-0.5 bg-primary"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">
            @foreach($categories as $category)
                <x-category-card :href="route('category', $category['slug'])" :image="$category['image']" :alt="$category['alt']" :title="$category['title']" :count="$category['count']" />
            @endforeach
        </div>
    </section>

    <x-collection-section label="الإضافات الأخيرة" title="وصلنا حديثاً" :viewAllUrl="route('new-arrivals')">
        @foreach($newArrivals as $product)
            <x-home-product-card :image="$product['image']" :alt="$product['alt']" :badge="$product['badge'] ?? null" :name="$product['name']" :category="$product['category']" :price="$product['price']" :originalPrice="$product['original_price'] ?? null" :href="route('product', $product['slug'])" />
        @endforeach
    </x-collection-section>

    <section class="py-32 bg-neutral-beige dark:bg-gray-900 overflow-hidden relative">
        <div class="container mx-auto px-4 max-w-4xl text-center relative z-10">
            <div class="inline-block p-4 bg-primary/20 rounded-full mb-8">
                <span class="material-symbols-outlined text-5xl text-primary">mail</span>
            </div>
            <h3 class="text-4xl lg:text-5xl font-extrabold mb-8 text-neutral-charcoal dark:text-white tracking-tight">انضم إلى عائلة تفصيلة</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-12 max-w-xl mx-auto text-lg font-light leading-relaxed">
                كن أول من يستقبل مجموعاتنا الحصرية وآخر صيحات الموضة. اشترك الآن واحصل على <span class="bg-primary px-2 text-white font-extrabold">خصم 10%</span> على طلبك الأول.
            </p>
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col md:flex-row gap-0 max-w-2xl mx-auto shadow-2xl overflow-hidden ring-1 ring-black/5">
                @csrf
                <input class="flex-grow py-6 px-8 border-none focus:ring-2 focus:ring-primary bg-white dark:bg-gray-800 text-base placeholder:text-gray-300 text-right" name="email" placeholder="أدخل بريدك الإلكتروني" required="" type="email" />
                <button type="submit" class="bg-primary text-white px-12 py-6 font-extrabold hover:bg-primary-dark transition-colors text-sm tracking-widest uppercase whitespace-nowrap">اشترك الآن</button>
            </form>
        </div>
        <div class="absolute top-1/2 left-0 w-[600px] h-[1px] bg-primary/20 -rotate-45 origin-left"></div>
        <div class="absolute bottom-1/2 right-0 w-[600px] h-[1px] bg-primary/20 -rotate-45 origin-right"></div>
    </section>

</x-layout.client>
