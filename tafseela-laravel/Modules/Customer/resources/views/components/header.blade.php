@props([
    'cartCount'     => 2,
    'wishlistCount' => 0,
])

<div class="bg-primary-dark text-white text-center py-2.5 text-[11px] font-bold tracking-[0.1em] uppercase border-b border-white/5">
    شحن مجاني للطلبات الأكثر من 500 جنيه مصري | كود الخصم: <span class="font-sans" dir="ltr">TAFSELA24</span>
</div>

<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100">
    <div class="container mx-auto px-4 lg:px-12 py-5 flex items-center justify-between gap-10">
        <div class="flex-shrink-0">
            <a href="{{ route('home') }}">
                <h1 class="text-3xl font-extrabold text-neutral-charcoal tracking-tighter uppercase italic">تفصيلة</h1>
            </a>
        </div>
        <div class="hidden md:flex flex-grow max-w-xl relative group">
            <input class="w-full bg-gray-50 border-gray-200 rounded-none py-3 pr-12 pl-4 focus:ring-1 focus:ring-primary focus:border-primary text-right text-xs transition-all placeholder:text-gray-400" placeholder="ابحث عن الملابس، الإكسسوارات..." type="text" />
            <span class="material-icons-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-neutral-charcoal transition-colors text-xl">search</span>
        </div>
        <div class="flex items-center gap-6 lg:gap-8">
            <button class="text-[11px] font-bold hover:text-primary transition-colors flex items-center gap-1.5 uppercase tracking-widest whitespace-nowrap">
                <span class="font-sans">English</span>
                <span class="material-symbols-outlined text-lg">language</span>
            </button>
            <div class="flex items-center gap-6 lg:gap-7">
                <a class="hover:text-primary transition-colors flex flex-col items-center gap-1" href="{{ auth()->check() ? route('account') : route('auth.signin') }}">
                    <span class="material-symbols-outlined text-[24px]">person</span>
                    <span class="text-[9px] font-bold hidden lg:block uppercase tracking-widest text-neutral-charcoal/60">{{ auth()->check() ? 'حسابي' : 'إنضم إلينا' }}</span>
                </a>
                <a class="hover:text-primary transition-colors flex flex-col items-center gap-1 relative" href="{{ auth()->check() ? route('wishlist') : route('auth.signin') }}">
                    <span class="material-symbols-outlined text-[24px]">favorite</span>
                    <span class="text-[9px] font-bold hidden lg:block uppercase tracking-widest text-neutral-charcoal/60">المفضلة</span>
                    <span id="wishlist-count-badge" class="absolute -top-1 -right-1 bg-primary text-white text-[8px] w-4 h-4 rounded-full flex items-center justify-center font-bold">{{ $wishlistCount }}</span>
                </a>
                <a class="hover:text-primary transition-colors flex flex-col items-center gap-1 relative" href="{{ auth()->check() ? route('cart') : route('auth.signin') }}">
                    <span class="material-symbols-outlined text-[24px]">shopping_bag</span>
                    <span class="text-[9px] font-bold hidden lg:block uppercase tracking-widest text-neutral-charcoal/60">السلة</span>
                    <span id="cart-count-badge" class="absolute -top-1 -right-1 bg-primary text-white text-[8px] w-4 h-4 rounded-full flex items-center justify-center font-bold">{{ $cartCount }}</span>
                </a>
            </div>
        </div>
    </div>
    <nav class="container mx-auto px-4 lg:px-12 pb-4 hidden md:block">
        <ul class="flex items-center gap-12 text-[12px] font-bold uppercase tracking-widest justify-center">
            <li><a class="{{ request()->routeIs('home') ? 'text-neutral-charcoal border-b-2 border-primary pb-1' : 'text-gray-500 hover:text-primary transition-colors pb-1 border-b-2 border-transparent hover:border-primary/30' }}" href="{{ route('home') }}">الرئيسية</a></li>
            <li><a class="{{ request()->routeIs('new-arrivals') ? 'text-neutral-charcoal border-b-2 border-primary pb-1' : 'text-gray-500 hover:text-primary transition-colors pb-1 border-b-2 border-transparent hover:border-primary/30' }}" href="{{ route('new-arrivals') }}">وصلنا حديثاً</a></li>

            @foreach($navCategories ?? [] as $navCategory)
                <li>
                    <a class="{{ request()->is('category/' . $navCategory->slug) ? 'text-neutral-charcoal border-b-2 border-primary pb-1' : 'text-gray-500 hover:text-primary transition-colors pb-1 border-b-2 border-transparent hover:border-primary/30' }}"
                       href="{{ route('category', $navCategory->slug) }}">
                        {{ $navCategory->title }}
                    </a>
                </li>
            @endforeach

            @if(\Modules\Product\Models\ProductDiscount::hasActiveDiscounts())
            <li><a class="{{ request()->routeIs('sale') ? 'text-neutral-charcoal border-b-2 border-primary pb-1' : 'text-neutral-charcoal/70 hover:text-primary transition-colors pb-1 border-b-2 border-transparent hover:border-primary/30' }}" href="{{ route('sale') }}">التخفيضات</a></li>
            @endif
        </ul>
    </nav>
</header>
