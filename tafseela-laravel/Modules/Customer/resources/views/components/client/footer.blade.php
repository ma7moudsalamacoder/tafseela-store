{{-- Client Footer Component --}}
<footer class="bg-primary-dark text-white pt-24 pb-12">
    <div class="container mx-auto px-4 lg:px-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-24">
        <div class="space-y-8">
            <h4 class="text-3xl font-extrabold tracking-tighter uppercase italic">تفصيلة</h4>
            <p class="text-white/70 leading-relaxed font-light text-sm">
                متجركم الأول للأزياء العصرية المصممة بدقة لتلائم أسلوب حياتكم. الجودة والفخامة في كل غرزة منذ عام 2020.
            </p>
            <div class="flex gap-4">
                <a aria-label="العودة للرئيسية" class="w-12 h-12 border border-white/20 flex items-center justify-center hover:bg-white hover:text-primary-dark transition-all duration-300" href="{{ route('customer.home') }}">
                    <i class="material-icons-outlined text-xl">facebook</i>
                </a>
                <a aria-label="جميع المنتجات" class="w-12 h-12 border border-white/20 flex items-center justify-center hover:bg-white hover:text-primary-dark transition-all duration-300" href="{{ route('customer.products.index') }}">
                    <span class="material-symbols-outlined text-xl">camera</span>
                </a>
                <a aria-label="تتبع الطلب" class="w-12 h-12 border border-white/20 flex items-center justify-center hover:bg-white hover:text-primary-dark transition-all duration-300" href="{{ route('customer.orders.tracking') }}">
                    <span class="material-symbols-outlined text-xl">alternate_email</span>
                </a>
            </div>
        </div>

        <div>
            <h5 class="font-bold text-xs uppercase tracking-[0.3em] mb-10 text-white">تسوق حسب الفئة</h5>
            <ul class="space-y-5 text-white/70 font-bold text-[11px] uppercase tracking-widest">
                <li><a class="hover:text-white transition-colors flex items-center gap-3" href="{{ route('customer.products.index') }}"><span class="w-4 h-[1px] bg-white/30"></span>وصلنا حديثاً</a></li>
                <li><a class="hover:text-white transition-colors flex items-center gap-3" href="{{ route('customer.sections.show', 'mens-shirts') }}"><span class="w-4 h-[1px] bg-white/30"></span>مجموعة الرجال</a></li>
                <li><a class="hover:text-white transition-colors flex items-center gap-3" href="{{ route('customer.sections.show', 'womens-dresses') }}"><span class="w-4 h-[1px] bg-white/30"></span>مجموعة النساء</a></li>
                <li><a class="hover:text-white transition-colors flex items-center gap-3" href="{{ route('customer.products.index') }}"><span class="w-4 h-[1px] bg-white/30"></span>ملابس الأطفال</a></li>
            </ul>
        </div>

        <div>
            <h5 class="font-bold text-xs uppercase tracking-[0.3em] mb-10 text-white">خدمة العملاء</h5>
            <ul class="space-y-5 text-white/70 font-bold text-[11px] uppercase tracking-widest">
                <li><a class="hover:text-white transition-colors" href="{{ route('customer.orders.tracking') }}">تتبع الطلبية</a></li>
                <li><a class="hover:text-white transition-colors" href="{{ route('customer.orders.completed') }}">سياسة الاسترجاع</a></li>
                <li><a class="hover:text-white transition-colors" href="{{ route('customer.checkout') }}">خيارات الشحن</a></li>
                <li><a class="hover:text-white transition-colors" href="{{ route('customer.products.index') }}">الأسئلة الشائعة</a></li>
            </ul>
        </div>

        <div>
            <h5 class="font-bold text-xs uppercase tracking-[0.3em] mb-10 text-white">تواصل معنا</h5>
            <ul class="space-y-6 text-white/70 text-[13px] font-medium">
                <li class="flex items-start gap-4">
                    <span class="material-symbols-outlined text-white text-xl mt-1">location_on</span>
                    <span class="leading-relaxed">شارع التسعين، التجمع الخامس، القاهرة، مصر</span>
                </li>
                <li class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-white text-xl">call</span>
                    <span class="font-bold tracking-wider" dir="ltr">+20 123 456 7890</span>
                </li>
                <li class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-white text-xl">mail</span>
                    <span class="tracking-wide">care@tafsela.com</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="border-t border-white/10 pt-12 text-center container mx-auto px-4 lg:px-12 flex flex-col md:flex-row justify-between items-center gap-8">
        <p class="text-white/50 text-[10px] font-bold tracking-[0.2em] uppercase">
            © {{ date('Y') }} تفصيلة <span class="font-sans" dir="ltr">Tafsela</span>. جميع الحقوق محفوظة
        </p>
        <div class="flex gap-8 opacity-40 grayscale items-center invert">
            <span class="material-symbols-outlined text-3xl">payments</span>
            <span class="material-symbols-outlined text-3xl">credit_card</span>
            <span class="material-symbols-outlined text-3xl">account_balance_wallet</span>
        </div>
    </div>
</footer>
