<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'تفصيلة - الطلبات' }}</title>
    <meta name="description" content="{{ $description ?? 'متابعة الطلبات وإتمام الشراء من تفصيلة' }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <style>
        .order-card { border: 1px solid rgb(243 244 246); background: white; box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05); }
    </style>

    @stack('styles')
</head>
<body class="font-body bg-background-light text-neutral-charcoal antialiased transition-colors duration-300 dark:bg-background-dark dark:text-gray-100">
    <div class="border-b border-white/5 bg-primary-dark py-2.5 text-center text-[11px] font-bold uppercase tracking-[0.1em] text-white">
        شحن مجاني للطلبات الأكثر من 500 جنيه مصري | كود الخصم: <span class="font-sans" dir="ltr">TAFSELA24</span>
    </div>

    <header class="border-b border-gray-100 bg-white/95 backdrop-blur-md dark:border-gray-800 dark:bg-background-dark/95">
        <div class="container mx-auto flex items-center justify-between px-4 py-6 lg:px-12">
            <a href="{{ route('customer.home') }}" class="text-3xl font-extrabold uppercase italic tracking-tighter text-neutral-charcoal dark:text-white">تفصيلة</a>

            <div class="hidden items-center gap-12 text-[12px] font-bold uppercase tracking-widest md:flex">
                {{ $steps ?? '' }}
            </div>

            <a href="{{ route('customer.products.index') }}" class="flex items-center gap-2 text-xs font-bold transition-colors hover:text-primary">
                <span class="material-symbols-outlined text-lg">shopping_bag</span>
                <span>العودة للمتجر</span>
            </a>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-primary-dark pb-12 pt-20 text-white">
        <div class="container mx-auto grid grid-cols-1 gap-16 px-4 lg:grid-cols-4 lg:px-12">
            <div class="space-y-6">
                <h4 class="text-3xl font-extrabold uppercase italic tracking-tighter">تفصيلة</h4>
                <p class="text-sm font-light leading-relaxed text-white/70">
                    متجركم الأول للأزياء العصرية المصممة بدقة لتلائم أسلوب حياتكم. الجودة والفخامة في كل غرزة منذ عام 2020.
                </p>
            </div>
            <div>
                <h5 class="mb-8 text-xs font-bold uppercase tracking-[0.3em] text-white">تسوق حسب الفئة</h5>
                <ul class="space-y-4 text-[11px] font-bold uppercase tracking-widest text-white/70">
                    <li><a href="{{ route('customer.products.index') }}" class="transition-colors hover:text-white">جميع المنتجات</a></li>
                    <li><a href="{{ route('customer.sections.show', 'mens-shirts') }}" class="transition-colors hover:text-white">مجموعة الرجال</a></li>
                </ul>
            </div>
            <div>
                <h5 class="mb-8 text-xs font-bold uppercase tracking-[0.3em] text-white">خدمة العملاء</h5>
                <ul class="space-y-4 text-[11px] font-bold uppercase tracking-widest text-white/70">
                    <li><a href="{{ route('customer.orders.tracking') }}" class="transition-colors hover:text-white">تتبع الطلبية</a></li>
                    <li><a href="{{ route('customer.checkout') }}" class="transition-colors hover:text-white">إتمام الشراء</a></li>
                </ul>
            </div>
            <div>
                <h5 class="mb-8 text-xs font-bold uppercase tracking-[0.3em] text-white">تواصل معنا</h5>
                <ul class="space-y-5 text-[13px] font-medium text-white/70">
                    <li class="flex items-start gap-4">
                        <span class="material-symbols-outlined mt-1 text-xl text-white">location_on</span>
                        <span>شارع التسعين، التجمع الخامس، القاهرة، مصر</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <span class="material-symbols-outlined text-xl text-white">call</span>
                        <span dir="ltr">+20 101 234 5678</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container mx-auto border-t border-white/10 px-4 pt-12 text-center lg:px-12">
            <p class="text-[10px] uppercase tracking-[0.2em] text-white/40">© 2024 جميع الحقوق محفوظة لشركة تفصيلة للأزياء</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
