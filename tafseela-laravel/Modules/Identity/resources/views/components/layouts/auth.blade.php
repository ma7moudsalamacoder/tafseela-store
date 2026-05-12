<x-identity::layouts.master>
    {{-- Main Container: Full viewport height, centered content --}}
    <div class="min-h-full flex flex-col items-center justify-center bg-warm-white p-gutter">

        {{-- Brand Name (Top) --}}
        <div class="w-full text-center mb-stack-lg">
            <h1 class="text-3xl font-bold tracking-widest text-charcoal font-almarai">
                {{ __('identity::auth.brand_name') }}
            </h1>
        </div>

        {{-- Central White Card --}}
        <div class="w-full sm:max-w-md bg-white border border-neutral-beige p-stack-md flex flex-col justify-center">

            {{-- Header: Icon & Title --}}
            @if(isset($icon) || isset($title))
                <div class="text-center mb-stack-md">
                    @if(isset($icon))
                        <div class="text-primary text-3xl mb-stack-sm">
                            <i class="{{ $icon }}"></i>
                        </div>
                    @endif
                    @if(isset($title))
                        <h2 class="text-xl font-medium text-charcoal font-almarai">
                            {{ $title }}
                        </h2>
                    @endif
                </div>
            @endif

            {{-- Form Content --}}
            <div class="w-full">
                {{ $slot }}
            </div>
        </div>

        {{-- Footer / Copyright: Full width on mobile, standard on desktop --}}
        <div class="w-full mt-stack-md text-center text-xs text-gray-500 py-4 border-t border-neutral-beige sm:border-0">
            &copy; {{ date('Y') }} {{ __('identity::auth.brand_name') }}. {{ __('identity::auth.all_rights_reserved') }}
        </div>
    </div>
</x-identity::layouts.master>

