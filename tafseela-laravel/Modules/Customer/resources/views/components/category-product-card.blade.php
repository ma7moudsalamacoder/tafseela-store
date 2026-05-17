@props(['product', 'productDetailId' => null, 'isInWishlist' => false])

<div {{ $attributes->merge(['class' => 'group product-card-shadow']) }}>
    <div class="relative aspect-[4/5] overflow-hidden bg-gray-50 mb-6">
        <a href="{{ route('product-detail', $product['id']) }}">
            <img alt="{{ $product['name'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ $product['image'] }}">
        </a>

        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>

        <!-- Action Buttons -->
        <div class="absolute bottom-4 left-4 right-4 translate-y-10 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-500 flex gap-2">
            <button type="button" onclick="addToCart({{ $product['id'] }}, this, {{ $productDetailId ?: 'null' }})" class="flex-grow bg-white text-neutral-charcoal hover:bg-[#8B5E3C] hover:text-white py-4 text-[10px] font-bold uppercase tracking-widest transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-base">shopping_bag</span>
                <span class="btn-text">إضافة سريعة</span>
            </button>
            <button type="button" onclick="toggleWishlist({{ $product['id'] }}, this)" class="bg-white text-neutral-charcoal hover:text-red-500 w-12 flex items-center justify-center transition-colors">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ $isInWishlist ? 1 : 0 }}">favorite</span>
            </button>
        </div>

        @if(isset($product['badge']))
            <span class="absolute top-4 right-4 bg-[#8B5E3C] text-white text-[9px] font-extrabold px-3 py-1 tracking-widest">{{ $product['badge'] }}</span>
        @endif
    </div>

    <div class="space-y-1">
        <h4 class="font-bold text-base hover:text-[#8B5E3C] transition-colors cursor-pointer tracking-tight font-display">
            <a href="{{ route('product-detail', $product['id']) }}">{{ $product['name'] }}</a>
        </h4>
        <p class="text-gray-400 text-[9px] font-bold uppercase tracking-widest">{{ $product['description'] }}</p>
        <div class="flex items-center gap-3 pt-2">
            <span class="font-bold text-lg text-[#8B5E3C]">{{ $product['price'] }}</span>
            @if(isset($product['old_price']))
                <span class="text-sm text-gray-300 line-through">{{ $product['old_price'] }}</span>
            @endif
        </div>
    </div>
</div>
