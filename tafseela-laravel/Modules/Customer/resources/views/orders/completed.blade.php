<x-customer::layouts.order title="تفصيلة - تم استلام طلبك" description="تفاصيل الطلب المكتمل من تفصيلة">
    <section class="container mx-auto px-4 py-16 lg:px-12">
        <div class="mx-auto max-w-3xl text-center">
            <div class="mb-8">
                <div class="inline-flex h-24 w-24 items-center justify-center rounded-full bg-success-green/10">
                    <span class="material-symbols-outlined text-6xl text-success-green">check_circle</span>
                </div>
            </div>
            <h2 class="mb-4 text-4xl font-extrabold text-neutral-charcoal dark:text-white">تم استلام طلبك بنجاح!</h2>
            <p class="mb-8 text-lg text-gray-500 dark:text-gray-400">شكراً لتسوقك مع تفصيلة. لقد أرسلنا تفاصيل طلبك إلى بريدك الإلكتروني.</p>
            <div class="mb-12 inline-block bg-neutral-beige px-6 py-3 dark:bg-gray-800">
                <span class="ml-2 font-bold text-gray-500 dark:text-gray-400">رقم الطلب:</span>
                <span class="font-sans font-bold text-primary">#{{ $order['number'] }}</span>
            </div>

            <div class="order-card mb-12 p-8 text-right dark:border-gray-800 dark:bg-neutral-charcoal/30">
                <div class="mb-6 flex items-center justify-between border-b border-gray-100 pb-4 dark:border-gray-800">
                    <h3 class="text-lg font-bold">ملخص الطلب</h3>
                    <span class="text-sm text-gray-400">{{ count($order['items']) }} قطع</span>
                </div>

                <div class="mb-8 space-y-6">
                    @foreach ($order['items'] as $item)
                        <div class="flex items-center gap-4">
                            <div class="h-20 w-16 bg-gray-50">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                            </div>
                            <div class="flex-grow">
                                <h4 class="text-sm font-bold">{{ $item['name'] }}</h4>
                                <p class="text-[10px] font-bold text-gray-400">{{ $item['meta'] }}</p>
                            </div>
                            <div class="text-sm font-bold">{{ $item['price'] }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="space-y-3 border-t border-gray-100 pt-6 dark:border-gray-800">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">المجموع الفرعي</span>
                        <span class="font-bold">{{ $order['summary']['subtotal'] }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">الشحن</span>
                        <span class="font-bold text-success-green">{{ $order['summary']['shipping'] }}</span>
                    </div>
                    <div class="mt-4 flex justify-between border-t border-gray-100 pt-4 text-xl font-bold text-primary dark:border-gray-800">
                        <span>الإجمالي</span>
                        <span>{{ $order['summary']['subtotal'] }}</span>
                    </div>
                </div>

                <div class="mt-8 flex items-center gap-4 bg-gray-50 p-4 dark:bg-gray-800/50">
                    <span class="material-symbols-outlined text-primary">local_shipping</span>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-400">تاريخ التوصيل المتوقع</p>
                        <p class="text-sm font-bold">{{ $order['expected_delivery'] }}</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ route('customer.orders.tracking') }}" class="bg-primary px-12 py-5 text-[12px] font-extrabold uppercase tracking-[0.2em] text-white shadow-xl shadow-primary/20 transition-all duration-300 hover:bg-primary-dark">
                    تتبع طلبك
                </a>
                <a href="{{ route('customer.products.index') }}" class="border-2 border-primary px-12 py-5 text-[12px] font-extrabold uppercase tracking-[0.2em] text-primary transition-all duration-300 hover:bg-primary hover:text-white">
                    متابعة التسوق
                </a>
            </div>
        </div>

        <section class="mt-32 border-t border-gray-100 pt-16 dark:border-gray-800">
            <div class="mb-12 text-center">
                <h3 class="mb-2 text-2xl font-extrabold">قد يعجبك أيضاً</h3>
                <div class="mx-auto h-1 w-12 bg-primary"></div>
            </div>
            <div class="grid grid-cols-2 gap-8 lg:grid-cols-4">
                @foreach ($recommendedProducts as $product)
                    <a href="{{ route('customer.products.show', $product['slug']) }}" class="space-y-4">
                        <div class="group relative aspect-[3/4] overflow-hidden bg-gray-100">
                            <img src="{{ $product['main_image'] }}" alt="{{ $product['name'] }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        </div>
                        <div>
                            <h4 class="text-sm font-bold">{{ $product['name'] }}</h4>
                            <p class="mt-1 text-sm font-bold text-primary">{{ $product['formatted_price'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </section>
</x-customer::layouts.order>
