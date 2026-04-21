{{-- Hero Banner Component --}}
<section class="relative min-h-[85vh] flex items-center overflow-hidden">
    {{-- Background Image --}}
    <div class="absolute inset-0">
        <img 
            src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1920&q=80" 
            alt="Tafsela Hero" 
            class="w-full h-full object-cover object-center"
        >
        <div class="absolute inset-0 bg-gradient-to-l from-white/95 via-white/60 to-transparent"></div>
    </div>

    {{-- Content --}}
    <div class="container mx-auto px-4 lg:px-12 relative z-10">
        <div class="max-w-2xl mr-auto lg:mr-0 lg:mr-8 text-right">
            <span class="inline-block text-[11px] font-bold uppercase tracking-[0.3em] text-primary mb-6">مجموعة 2024</span>
            <h2 class="text-6xl lg:text-8xl font-extrabold text-neutral-charcoal tracking-tighter leading-none mb-6">
                تفصيلة
            </h2>
            <p class="text-xl lg:text-2xl text-gray-600 font-light leading-relaxed mb-10 max-w-lg">
                اكتشف الفخامة في كل تفصيلة. أزياء مصممة بدقة لتليق بك وبأسلوب حياتك العصري.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('customer.products.index') }}" class="inline-block bg-primary text-white px-12 py-5 text-[12px] font-extrabold uppercase tracking-widest hover:bg-primary-dark transition-colors luxury-button-hover">
                    تسوق الآن
                </a>
                <a href="{{ route('customer.sections.show', 'mens-shirts') }}" class="inline-block bg-transparent border-2 border-neutral-charcoal text-neutral-charcoal px-12 py-5 text-[12px] font-extrabold uppercase tracking-widest hover:bg-neutral-charcoal hover:text-white transition-colors">
                    شاهد المزيد
                </a>
            </div>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-gray-400">
        <span class="text-[10px] font-bold uppercase tracking-widest">اكتشف</span>
        <span class="material-symbols-outlined animate-bounce">keyboard_arrow_down</span>
    </div>
</section>
