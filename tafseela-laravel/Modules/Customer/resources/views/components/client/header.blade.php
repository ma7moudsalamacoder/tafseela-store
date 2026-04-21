{{-- Client Header Component --}}
@php
    $favoritesCount = 3;
    $cartCount = 2;
@endphp

<div class="bg-primary-dark text-white text-center py-2.5 text-[11px] font-bold tracking-[0.1em] uppercase border-b border-white/5">
    شحن مجاني للطلبات الأكثر من 500 جنيه مصري | كود الخصم: <span class="font-sans" dir="ltr">TAFSELA24</span>
</div>

<header class="sticky top-0 z-50 bg-white/95 dark:bg-background-dark/95 backdrop-blur-md border-b border-gray-100 dark:border-gray-800">
    <div class="container mx-auto px-4 lg:px-12 py-5 flex items-center justify-between gap-10">
        <div class="flex-shrink-0">
            <a href="{{ route('customer.home') }}">
                <h1 class="text-3xl font-extrabold text-neutral-charcoal dark:text-white tracking-tighter uppercase italic">تفصيلة</h1>
            </a>
        </div>

        <div class="hidden md:flex flex-grow max-w-xl relative group">
            <input 
                class="w-full bg-gray-50 dark:bg-gray-800/50 border-gray-200 dark:border-gray-700 rounded-none py-3 pr-12 pl-4 focus:ring-1 focus:ring-primary focus:border-primary text-right text-xs transition-all placeholder:text-gray-400" 
                placeholder="ابحث عن الملابس، الإكسسوارات..." 
                type="text"
            >
            <span class="material-icons-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-neutral-charcoal transition-colors text-xl">search</span>
        </div>

        <div class="flex items-center gap-6 lg:gap-8">
            <button class="text-[11px] font-bold hover:text-primary transition-colors flex items-center gap-1.5 uppercase tracking-widest whitespace-nowrap">
                <span class="font-sans">English</span>
                <span class="material-symbols-outlined text-lg">language</span>
            </button>

            <div class="flex items-center gap-6 lg:gap-7">
                <a class="hover:text-primary transition-colors flex flex-col items-center gap-1" href="{{ route('customer.orders.tracking') }}">
                    <span class="material-symbols-outlined text-[24px]">person</span>
                    <span class="text-[9px] font-bold hidden lg:block uppercase tracking-widest text-neutral-charcoal/60 dark:text-gray-400">حسابي</span>
                </a>

                <button type="button" class="hover:text-primary transition-colors flex flex-col items-center gap-1 relative" data-drawer-target="favorites" aria-controls="favorites-drawer" aria-expanded="false">
                    <span class="material-symbols-outlined text-[24px]">favorite</span>
                    <span class="text-[9px] font-bold hidden lg:block uppercase tracking-widest text-neutral-charcoal/60 dark:text-gray-400">المفضلة</span>
                    <span class="absolute -top-1 -right-1 bg-primary text-white text-[8px] w-4 h-4 rounded-full flex items-center justify-center font-bold">{{ $favoritesCount }}</span>
                </button>

                <button type="button" class="hover:text-primary transition-colors flex flex-col items-center gap-1 relative" data-drawer-target="cart" aria-controls="cart-drawer" aria-expanded="false">
                    <span class="material-symbols-outlined text-[24px]">shopping_bag</span>
                    <span class="text-[9px] font-bold hidden lg:block uppercase tracking-widest text-neutral-charcoal/60 dark:text-gray-400">السلة</span>
                    <span class="absolute -top-1 -right-1 bg-primary text-white text-[8px] w-4 h-4 rounded-full flex items-center justify-center font-bold">{{ $cartCount }}</span>
                </button>
            </div>
        </div>
    </div>

    <nav class="container mx-auto px-4 lg:px-12 pb-4 hidden md:block">
        <ul class="flex items-center gap-12 text-[12px] font-bold uppercase tracking-widest justify-center">
            <li><a class="text-neutral-charcoal border-b-2 border-primary pb-1 dark:text-primary" href="{{ route('customer.home') }}">الرئيسية</a></li>
            <li><a class="text-gray-500 dark:text-gray-400 hover:text-primary transition-colors pb-1 border-b-2 border-transparent hover:border-primary/30" href="{{ route('customer.products.index') }}">جميع المنتجات</a></li>
            <li><a class="text-gray-500 dark:text-gray-400 hover:text-primary transition-colors pb-1 border-b-2 border-transparent hover:border-primary/30" href="{{ route('customer.products.index') }}">وصلنا حديثاً</a></li>
            <li><a class="text-gray-500 dark:text-gray-400 hover:text-primary transition-colors pb-1 border-b-2 border-transparent hover:border-primary/30" href="{{ route('customer.sections.show', 'mens-shirts') }}">رجالي</a></li>
            <li><a class="text-gray-500 dark:text-gray-400 hover:text-primary transition-colors pb-1 border-b-2 border-transparent hover:border-primary/30" href="{{ route('customer.sections.show', 'womens-dresses') }}">نسائي</a></li>
            <li><a class="text-gray-500 dark:text-gray-400 hover:text-primary transition-colors pb-1 border-b-2 border-transparent hover:border-primary/30" href="{{ route('customer.products.index') }}">أطفال</a></li>
            <li><a class="text-gray-500 dark:text-gray-400 hover:text-primary transition-colors pb-1 border-b-2 border-transparent hover:border-primary/30" href="{{ route('customer.orders.tracking') }}">تتبع الطلب</a></li>
        </ul>
    </nav>
</header>
