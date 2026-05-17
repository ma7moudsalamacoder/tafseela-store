@props([
    'image'         => '',
    'alt'           => '',
    'badge'         => null,
    'name'          => '',
    'category'      => '',
    'price'         => '',
    'originalPrice' => null,
    'productId'     => null,
    'productDetailId' => null,
    'isInWishlist'  => false,
])

@php $detailUrl = route('product-detail', $productId); @endphp

<div class="min-w-[300px] lg:min-w-[350px] group snap-start product-card-shadow">
    <div class="relative aspect-[4/5] overflow-hidden bg-gray-50 mb-6">
        <a href="{{ $detailUrl }}">
            <img alt="{{ $alt }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $image }}" />
        </a>

        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>

        <div class="absolute bottom-4 left-4 right-4 translate-y-10 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-500 flex gap-2">
            <button type="button" onclick="addToCart({{ $productId }}, this, {{ $productDetailId ?: 'null' }})" class="flex-grow bg-white text-neutral-charcoal hover:bg-[#8B5E3C] hover:text-white py-4 text-[10px] font-bold uppercase tracking-widest transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-base">shopping_bag</span>
                <span class="btn-text">إضافة سريعة</span>
            </button>
            <button type="button" onclick="toggleWishlist({{ $productId }}, this)" class="bg-white text-neutral-charcoal hover:text-red-500 w-12 flex items-center justify-center transition-colors">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ $isInWishlist ? 1 : 0 }}">favorite</span>
            </button>
        </div>

        @if($badge)
            <span class="absolute top-6 right-6 bg-primary text-white text-[10px] font-extrabold px-4 py-1.5 tracking-widest shadow-lg">{{ $badge }}</span>
        @endif
    </div>
    <div class="px-2">
        <h4 class="font-bold text-lg mb-1 hover:text-primary transition-colors cursor-pointer tracking-tight">
            <a href="{{ $detailUrl }}">{{ $name }}</a>
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
