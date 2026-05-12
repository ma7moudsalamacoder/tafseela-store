@props([
    'image'         => '',
    'alt'           => '',
    'badge'         => null,
    'name'          => '',
    'category'      => '',
    'price'         => '',
    'originalPrice' => null,
    'href'          => '#',
])

<div class="min-w-[300px] lg:min-w-[350px] group snap-start product-card-shadow">
    <div class="relative aspect-[4/5] overflow-hidden bg-gray-50 mb-6">
        <a href="{{ $href }}">
            <img alt="{{ $alt }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $image }}" />
        </a>
        <button class="absolute bottom-0 left-0 right-0 bg-primary text-white py-5 font-extrabold text-[11px] uppercase tracking-[0.2em] opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-full group-hover:translate-y-0 z-10">
            أضف إلى السلة
        </button>
        @if($badge)
            <span class="absolute top-6 right-6 bg-primary text-white text-[10px] font-extrabold px-4 py-1.5 tracking-widest shadow-lg">{{ $badge }}</span>
        @endif
    </div>
    <div class="px-2">
        <h4 class="font-bold text-lg mb-1 hover:text-primary transition-colors cursor-pointer tracking-tight">
            <a href="{{ $href }}">{{ $name }}</a>
        </h4>
        <p class="text-gray-400 text-[10px] mb-3 font-bold uppercase tracking-widest">{{ $category }}</p>
        <div class="flex items-center gap-4">
            <span class="font-bold text-xl text-primary">{{ $price }}</span>
            @if($originalPrice)
                <span class="text-sm text-gray-300 line-through">{{ $originalPrice }}</span>
            @endif
        </div>
    </div>
</div>
