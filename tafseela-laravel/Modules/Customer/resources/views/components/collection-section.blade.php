@props([
    'label'      => '',
    'title'      => '',
    'viewAllUrl' => '#',
    'viewAllLabel' => 'عرض جميع المنتجات',
])

<section class="py-24 bg-white dark:bg-gray-900/10">
    <div class="container mx-auto px-4 lg:px-12">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="space-y-3">
                @if($label)
                    <span class="text-primary font-bold text-[10px] tracking-[0.3em] uppercase">{{ $label }}</span>
                @endif
                <h3 class="text-4xl font-extrabold">{{ $title }}</h3>
            </div>
            <a class="text-neutral-charcoal dark:text-white font-bold text-[11px] flex items-center gap-3 hover:text-primary transition-all border-b-2 border-neutral-charcoal/10 hover:border-primary pb-2 tracking-widest" href="{{ $viewAllUrl }}">
                {{ $viewAllLabel }}
                <span class="material-symbols-outlined text-base">arrow_back</span>
            </a>
        </div>
        <div class="flex overflow-x-auto gap-8 hide-scrollbar pb-12 snap-x">
            {{ $slot }}
        </div>
    </div>
</section>
