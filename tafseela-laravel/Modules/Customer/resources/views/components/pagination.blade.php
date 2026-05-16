@if ($paginator->hasPages())
    <nav class="flex items-center justify-center gap-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="w-10 h-10 flex items-center justify-center border border-gray-200 text-gray-300 text-sm rounded cursor-default">
                <span class="material-symbols-outlined text-sm">chevron_right</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center border border-gray-200 text-gray-500 hover:border-[#8B5E3C] hover:text-[#8B5E3C] text-sm rounded transition-colors">
                <span class="material-symbols-outlined text-sm">chevron_right</span>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @isset($elements)
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="w-10 h-10 flex items-center justify-center text-gray-300 text-sm font-bold">...</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-10 h-10 flex items-center justify-center bg-[#8B5E3C] text-white text-sm font-bold rounded">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center border border-gray-200 text-gray-500 hover:border-[#8B5E3C] hover:text-[#8B5E3C] text-sm font-bold rounded transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        @endisset

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center border border-gray-200 text-gray-500 hover:border-[#8B5E3C] hover:text-[#8B5E3C] text-sm rounded transition-colors">
                <span class="material-symbols-outlined text-sm">chevron_left</span>
            </a>
        @else
            <span class="w-10 h-10 flex items-center justify-center border border-gray-200 text-gray-300 text-sm rounded cursor-default">
                <span class="material-symbols-outlined text-sm">chevron_left</span>
            </span>
        @endif
    </nav>
@endif
