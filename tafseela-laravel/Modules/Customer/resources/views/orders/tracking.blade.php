<x-customer::layouts.order title="تفصيلة - تتبع الطلب" description="تتبع حالة طلبك من تفصيلة">
    <section class="container mx-auto px-4 py-12 lg:px-12">
        <nav class="mb-8 flex gap-2 text-xs font-bold uppercase tracking-widest text-gray-400">
            <a href="{{ route('customer.home') }}" class="transition-colors hover:text-primary">الرئيسية</a>
            <span>/</span>
            <span class="text-neutral-charcoal dark:text-gray-200">تتبع طلبك</span>
        </nav>

        <div class="mb-12">
            <h2 class="mb-2 text-3xl font-extrabold text-neutral-charcoal dark:text-white">تتبع طلبك</h2>
            <p class="text-gray-500 dark:text-gray-400">طلب رقم <span class="font-sans font-bold text-primary">#{{ $order['number'] }}</span> | تم الطلب في {{ $order['placed_at'] }}</p>
        </div>

        <div class="relative mb-16">
            <div class="relative mx-auto flex max-w-5xl justify-between">
                <div class="absolute left-0 right-0 top-5 h-0.5 bg-gray-200 dark:bg-gray-700"></div>
                <div class="absolute right-0 top-5 h-0.5 w-[66%] bg-primary"></div>
                @foreach ([
                    ['icon' => 'check', 'label' => 'تم تأكيد الطلب', 'active' => true, 'filled' => true],
                    ['icon' => 'inventory_2', 'label' => 'قيد التجهيز', 'active' => true, 'filled' => true],
                    ['icon' => 'local_shipping', 'label' => 'تم الشحن', 'active' => true, 'filled' => false],
                    ['icon' => 'home_pin', 'label' => 'تم التوصيل', 'active' => false, 'filled' => false],
                ] as $step)
                    <div class="relative z-10 flex flex-col items-center gap-3 bg-background-light px-2 dark:bg-background-dark">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full {{ $step['filled'] ? 'bg-primary text-white' : ($step['active'] ? 'border-2 border-primary bg-white text-primary dark:bg-neutral-charcoal' : 'border-2 border-gray-200 bg-white text-gray-300 dark:border-gray-700 dark:bg-neutral-charcoal') }}">
                            <span class="material-symbols-outlined text-xl">{{ $step['icon'] }}</span>
                        </div>
                        <span class="text-sm font-bold {{ $step['active'] ? 'text-primary' : 'text-gray-400' }}">{{ $step['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <div class="space-y-8 lg:col-span-2">
                <div class="order-card p-8 dark:border-gray-800 dark:bg-neutral-charcoal/30">
                    <div class="flex flex-col justify-between gap-6 border-b border-gray-100 pb-6 md:flex-row md:items-center dark:border-gray-800">
                        <div>
                            <p class="mb-1 text-[10px] font-bold uppercase tracking-widest text-gray-400">شركة الشحن</p>
                            <h3 class="text-lg font-bold">{{ $order['tracking']['carrier'] }}</h3>
                        </div>
                        <div>
                            <p class="mb-1 text-[10px] font-bold uppercase tracking-widest text-gray-400">رقم التتبع</p>
                            <div class="flex items-center gap-3">
                                <span class="font-sans text-lg font-bold text-primary">{{ $order['tracking']['number'] }}</span>
                                <button type="button" class="flex items-center text-gray-400 transition-colors hover:text-primary" title="نسخ رقم التتبع">
                                    <span class="material-symbols-outlined text-lg">content_copy</span>
                                </button>
                            </div>
                        </div>
                        <div class="bg-success-green/10 px-4 py-2 text-xs font-bold text-success-green">
                            {{ $order['tracking']['status'] }}
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="mb-8 text-lg font-bold">تفاصيل التتبع</h3>
                        <div class="relative space-y-0">
                            <div class="absolute bottom-2 right-3.5 top-2 w-0.5 bg-gray-100 dark:bg-gray-800"></div>
                            @foreach ($order['timeline'] as $entry)
                                <div class="relative {{ $loop->last ? '' : 'pb-8' }} pr-10">
                                    <div class="absolute right-0 top-1.5 h-7 w-7 rounded-full border-4 border-white shadow-sm dark:border-neutral-charcoal {{ $entry['active'] ? 'bg-primary' : 'bg-gray-200 dark:bg-gray-700' }}"></div>
                                    <div class="flex flex-col md:flex-row md:justify-between">
                                        <div>
                                            <h4 class="text-sm font-bold {{ $entry['active'] ? '' : 'text-gray-500' }}">{{ $entry['title'] }}</h4>
                                            <p class="mt-1 text-xs {{ $entry['active'] ? 'text-gray-500' : 'text-gray-400' }}">{{ $entry['location'] }}</p>
                                        </div>
                                        <div class="mt-2 text-left md:mt-0">
                                            <p class="text-xs font-bold {{ $entry['active'] ? 'text-neutral-charcoal dark:text-gray-300' : 'text-gray-400' }}">{{ $entry['date'] }}</p>
                                            <p class="font-sans text-[10px] text-gray-400">{{ $entry['time'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="order-card p-8 dark:border-gray-800 dark:bg-neutral-charcoal/30">
                    <h3 class="mb-6 border-b border-gray-100 pb-4 text-lg font-bold dark:border-gray-800">ملخص الطلب</h3>
                    <div class="mb-8 space-y-6">
                        @foreach ($order['items'] as $item)
                            <div class="flex items-center gap-4">
                                <div class="h-18 w-14 flex-shrink-0 bg-gray-50">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                                </div>
                                <div class="flex-grow">
                                    <h4 class="text-xs font-bold">{{ $item['name'] }}</h4>
                                    <p class="text-[10px] font-bold text-gray-400">{{ $item['meta'] }}</p>
                                </div>
                                <div class="text-xs font-bold">{{ $item['price'] }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="space-y-2 border-t border-gray-100 pt-4 dark:border-gray-800">
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-500">المجموع</span>
                            <span class="font-bold">{{ $order['summary']['subtotal'] }}</span>
                        </div>
                    </div>
                </div>

                <div class="order-card p-8 dark:border-gray-800 dark:bg-neutral-charcoal/30">
                    <h3 class="mb-6 border-b border-gray-100 pb-4 text-lg font-bold dark:border-gray-800">معلومات التوصيل</h3>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <span class="material-symbols-outlined text-primary">location_on</span>
                            <div>
                                <p class="mb-1 text-[10px] font-bold uppercase tracking-widest text-gray-400">عنوان الشحن</p>
                                <p class="text-sm font-bold leading-relaxed">
                                    {{ $order['shipping_address']['name'] }}<br>
                                    {{ $order['shipping_address']['line1'] }}<br>
                                    {{ $order['shipping_address']['city'] }}
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-4 border-t border-gray-100 pt-6 dark:border-gray-800">
                            <span class="material-symbols-outlined text-primary">schedule</span>
                            <div>
                                <p class="mb-1 text-[10px] font-bold uppercase tracking-widest text-gray-400">موعد الوصول المتوقع</p>
                                <p class="text-sm font-bold">{{ $order['expected_delivery'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
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
