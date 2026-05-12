@props([
    'href'  => '#',
    'image' => '',
    'alt'   => '',
    'title' => '',
    'count' => '',
])

<a class="group relative aspect-[3/4] overflow-hidden bg-gray-100" href="{{ $href }}">
    <img alt="{{ $alt }}" class="w-full h-full object-cover transition-transform duration-[1.5s] group-hover:scale-110" src="{{ $image }}" />
    <div class="absolute inset-0 bg-neutral-charcoal/10 group-hover:bg-neutral-charcoal/30 transition-colors duration-700"></div>
    <div class="absolute bottom-0 inset-x-0 bg-white/95 dark:bg-background-dark/95 p-8 text-center backdrop-blur-md translate-y-4 group-hover:translate-y-0 transition-all duration-700">
        <h4 class="text-2xl font-extrabold mb-1">{{ $title }}</h4>
        @if($count)
            <p class="text-[10px] text-gray-500 mb-6 font-bold uppercase tracking-[0.2em]">{{ $count }}</p>
        @endif
        <span class="text-white font-extrabold text-[11px] bg-primary px-4 py-2 tracking-widest opacity-0 group-hover:opacity-100 transition-opacity duration-700 uppercase">اكتشف المجموعة</span>
    </div>
</a>
