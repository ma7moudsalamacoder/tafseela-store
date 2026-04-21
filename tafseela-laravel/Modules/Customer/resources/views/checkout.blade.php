<x-customer::layouts.order title="تفصيلة - إتمام الشراء" description="إتمام شراء منتجات تفصيلة">
    <x-slot:steps>
        <div class="flex items-center gap-2 text-gray-400">
            <span>السلة</span>
            <span class="material-symbols-outlined text-sm">chevron_left</span>
        </div>
        <div class="border-b-2 border-primary pb-1 font-bold text-primary">الشحن</div>
        <div class="flex items-center gap-2 text-gray-400">
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <span>الدفع</span>
        </div>
        <div class="flex items-center gap-2 text-gray-400">
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <span>المراجعة</span>
        </div>
    </x-slot:steps>

    <section class="container mx-auto px-4 py-12 lg:px-12">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-12">
            <div class="space-y-12 lg:col-span-7">
                <section>
                    <div class="mb-8 flex items-center gap-4">
                        <span class="flex h-10 w-10 items-center justify-center bg-primary/10 text-lg font-bold text-primary">1</span>
                        <h2 class="text-2xl font-extrabold">عنوان الشحن</h2>
                    </div>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold uppercase tracking-wider text-gray-500">الاسم الأول</label>
                            <input type="text" placeholder="مثال: أحمد" class="w-full border-gray-200 bg-gray-50/50 px-4 py-3 focus:border-primary focus:ring-primary">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold uppercase tracking-wider text-gray-500">اسم العائلة</label>
                            <input type="text" placeholder="مثال: محمد" class="w-full border-gray-200 bg-gray-50/50 px-4 py-3 focus:border-primary focus:ring-primary">
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-[11px] font-bold uppercase tracking-wider text-gray-500">العنوان بالتفصيل</label>
                            <input type="text" placeholder="رقم المبنى، اسم الشارع، المنطقة" class="w-full border-gray-200 bg-gray-50/50 px-4 py-3 focus:border-primary focus:ring-primary">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold uppercase tracking-wider text-gray-500">المدينة</label>
                            <select class="w-full border-gray-200 bg-gray-50/50 px-4 py-3 focus:border-primary focus:ring-primary">
                                <option>القاهرة</option>
                                <option>الجيزة</option>
                                <option>الإسكندرية</option>
                                <option>أخرى</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold uppercase tracking-wider text-gray-500">رقم الهاتف</label>
                            <input type="tel" dir="ltr" placeholder="+20 1XX XXX XXXX" class="w-full border-gray-200 bg-gray-50/50 px-4 py-3 text-right focus:border-primary focus:ring-primary">
                        </div>
                    </div>
                </section>

                <hr class="border-gray-100">

                <section>
                    <div class="mb-8 flex items-center gap-4">
                        <span class="flex h-10 w-10 items-center justify-center bg-primary/10 text-lg font-bold text-primary">2</span>
                        <h2 class="text-2xl font-extrabold">طريقة الدفع</h2>
                    </div>
                    <div class="space-y-4">
                        <label class="flex cursor-pointer items-center justify-between border-2 border-primary bg-primary/5 p-5">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="payment" checked class="h-5 w-5 text-primary focus:ring-primary">
                                <div class="space-y-1">
                                    <span class="block font-bold">الدفع عند الاستلام</span>
                                    <span class="block text-xs text-gray-500">ادفع نقداً عند وصول طلبك إلى منزلك</span>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-3xl text-primary">payments</span>
                        </label>
                        <label class="flex cursor-pointer items-center justify-between border border-gray-200 p-5 transition-all hover:border-primary/50">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="payment" class="h-5 w-5 text-primary focus:ring-primary">
                                <div class="space-y-1">
                                    <span class="block font-bold">بطاقة ائتمان / ميزة</span>
                                    <span class="block text-xs text-gray-500">دفع آمن وسريع عبر البطاقات البنكية</span>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-3xl text-gray-400">credit_card</span>
                        </label>
                    </div>
                </section>
            </div>

            <div class="lg:col-span-5">
                <div class="sticky top-28 border border-neutral-charcoal/5 bg-neutral-beige p-8">
                    <h3 class="mb-8 border-b border-neutral-charcoal/10 pb-4 text-xl font-extrabold uppercase tracking-widest">ملخص الطلب</h3>
                    <div class="mb-8 max-h-[400px] space-y-6 overflow-y-auto pr-2">
                        @foreach ($order['items'] as $item)
                            <div class="flex gap-4">
                                <div class="h-24 w-20 flex-shrink-0 bg-gray-200">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                                </div>
                                <div class="flex flex-grow flex-col justify-between">
                                    <div>
                                        <h4 class="text-sm font-bold">{{ $item['name'] }}</h4>
                                        <p class="mt-1 text-[10px] font-bold uppercase tracking-widest text-gray-500">{{ $item['category'] }}</p>
                                    </div>
                                    <div class="flex items-end justify-between">
                                        <span class="text-xs font-bold text-gray-400">الكمية: {{ $item['quantity'] }}</span>
                                        <span class="font-bold text-primary">{{ $item['price'] }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-8 flex gap-2">
                        <input type="text" placeholder="كود الخصم" class="flex-grow border-gray-200 px-4 py-3 text-xs focus:border-primary focus:ring-primary">
                        <button type="button" class="bg-neutral-charcoal px-6 py-3 text-xs font-bold uppercase tracking-widest text-white transition-colors hover:bg-black">تطبيق</button>
                    </div>

                    <div class="space-y-4 border-t border-neutral-charcoal/10 pt-6">
                        <div class="flex justify-between text-sm">
                            <span class="font-medium text-gray-500">المجموع الفرعي</span>
                            <span class="font-bold">{{ $order['summary']['subtotal'] }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="font-medium text-gray-500">مصاريف الشحن</span>
                            <span class="font-bold uppercase tracking-widest text-green-600">{{ $order['summary']['shipping'] }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="font-medium text-gray-500">الخصم (10%)</span>
                            <span class="font-bold text-red-500">{{ $order['summary']['discount'] }}</span>
                        </div>
                        <div class="flex justify-between border-t border-neutral-charcoal/10 pt-4 text-xl font-extrabold">
                            <span>الإجمالي</span>
                            <span class="text-primary">{{ $order['summary']['total'] }}</span>
                        </div>
                    </div>

                    <a href="{{ route('customer.orders.completed') }}" class="mt-10 flex w-full items-center justify-center gap-4 bg-primary py-6 text-sm font-extrabold uppercase tracking-[0.2em] text-white shadow-xl shadow-primary/20 transition-all hover:bg-primary-dark">
                        تأكيد الطلب
                        <span class="material-symbols-outlined text-lg">check_circle</span>
                    </a>
                    <p class="mt-6 text-center text-[10px] leading-relaxed text-gray-400">
                        بالضغط على تأكيد الطلب، فإنك توافق على <a href="{{ route('customer.home') }}" class="underline">شروط وأحكام</a> تفصيلة وسياسة الخصوصية.
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-customer::layouts.order>
