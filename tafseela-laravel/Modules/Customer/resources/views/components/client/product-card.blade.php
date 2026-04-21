{{-- Product Card Component --}}
@props([
    'product' => [
        'id' => 1,
        'slug' => null,
        'name' => 'بدلة رسمية كلاسيكية',
        'image' => 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=600',
        'price' => 2450,
        'old_price' => null,
        'category' => 'رجالي - رسمي'
    ]
])

@php
    $productUrl = !empty($product['slug']) ? route('customer.products.show', $product['slug']) : route('customer.products.index');
@endphp

<article class="group product-card-shadow bg-white relative">
    {{-- Image Container --}}
    <div class="relative aspect-[3/4] overflow-hidden bg-gray-100">
        <a href="{{ $productUrl }}" class="block h-full">
            <img 
                src="{{ $product['image'] }}" 
                alt="{{ $product['name'] }}" 
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                loading="lazy"
            >
        </a>
        
        {{-- Overlay Actions --}}
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300">
            <div class="absolute top-4 left-4 flex flex-col gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                {{-- Wishlist Button --}}
                <button class="w-10 h-10 bg-white shadow-lg flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-xl">favorite_border</span>
                </button>
                {{-- Quick View --}}
                <button class="w-10 h-10 bg-white shadow-lg flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-xl">visibility</span>
                </button>
            </div>
        </div>

        {{-- Sale Badge --}}
        @if($product['old_price'])
            <div class="absolute top-4 right-4 bg-primary text-white text-[10px] font-bold px-3 py-1 uppercase tracking-wider">
                خصم {{ round((($product['old_price'] - $product['price']) / $product['old_price']) * 100) }}%
            </div>
        @endif
    </div>

    {{-- Content --}}
    <div class="p-5 text-center">
        <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">{{ $product['category'] }}</p>
        <h3 class="text-sm font-bold text-neutral-charcoal mb-3 leading-snug">
            <a href="{{ $productUrl }}" class="hover:text-primary transition-colors">{{ $product['name'] }}</a>
        </h3>
        
        <div class="flex items-center justify-center gap-3">
            <span class="font-bold text-lg text-primary">{{ number_format($product['price']) }} جنيه</span>
            @if($product['old_price'])
                <span class="text-sm text-gray-400 line-through">{{ number_format($product['old_price']) }}</span>
            @endif
        </div>

        {{-- Add to Cart Button --}}
        <a href="{{ $productUrl }}" class="mt-4 block w-full bg-neutral-charcoal text-white py-3 text-[11px] font-bold uppercase tracking-widest hover:bg-primary transition-colors luxury-button-hover">
            أضف للسلة
        </a>
    </div>
</article>
