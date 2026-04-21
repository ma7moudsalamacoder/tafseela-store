{{-- Newsletter Component --}}
<section class="py-32 bg-neutral-beige dark:bg-gray-900 overflow-hidden relative">
    <div class="container mx-auto px-4 max-w-4xl text-center relative z-10">
        <div class="inline-block p-4 bg-primary/20 rounded-full mb-8">
            <span class="material-symbols-outlined text-5xl text-primary">mail</span>
        </div>
        
        <h3 class="text-4xl lg:text-5xl font-extrabold mb-8 text-neutral-charcoal dark:text-white tracking-tight">
            انضم إلى عائلة تفصيلة
        </h3>
        
        <p class="text-gray-600 dark:text-gray-400 mb-12 max-w-xl mx-auto text-lg font-light leading-relaxed">
            كن أول من يستقبل مجموعاتنا الحصرية وآخر صيحات الموضة. اشترك الآن واحصل على 
            <span class="bg-primary px-2 text-white font-extrabold">خصم 10%</span> 
            على طلبك الأول.
        </p>

        <x-customer::components.client.newsletter-status />

        <form class="flex flex-col md:flex-row gap-0 max-w-2xl mx-auto shadow-2xl overflow-hidden ring-1 ring-black/5" action="{{ route('newsletter.subscribe') }}" method="POST">
            @csrf
            <input 
                class="flex-grow py-6 px-8 border-none focus:ring-2 focus:ring-primary bg-white dark:bg-gray-800 text-base placeholder:text-gray-300 text-right" 
                placeholder="أدخل بريدك الإلكتروني" 
                name="email"
                type="email"
                required
            >
            <button 
                type="submit"
                class="bg-primary text-white px-12 py-6 font-extrabold hover:bg-primary-dark transition-colors text-sm tracking-widest uppercase whitespace-nowrap"
            >
                اشترك الآن
            </button>
        </form>
    </div>

    {{-- Decorative Lines --}}
    <div class="absolute top-1/2 left-0 w-[600px] h-[1px] bg-primary/20 -rotate-45 origin-left"></div>
    <div class="absolute bottom-1/2 right-0 w-[600px] h-[1px] bg-primary/20 -rotate-45 origin-right"></div>
</section>
