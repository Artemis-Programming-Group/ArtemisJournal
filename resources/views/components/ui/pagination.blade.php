@if ($paginator->hasPages())
    <nav class="flex items-center justify-between">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('Showing') }} <span class="font-medium">{{ $paginator->firstItem() }}</span> {{ __('to') }}
            <span class="font-medium">{{ $paginator->lastItem() }}</span> {{ __('of') }}
            <span class="font-medium">{{ $paginator->total() }}</span> {{ __('results') }}
        </div>

        <div class="flex gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 text-gray-400 cursor-not-allowed">← {{ __('Previous') }}</span>
            @else
                <a wireNavigate href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                    ← {{ __('Previous') }}
                </a>
            @endif

            {{-- Pagination Links --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-2 py-2 text-gray-600 dark:text-gray-400">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-2 bg-blue-600 text-white rounded-lg font-medium">{{ $page }}</span>
                        @else
                            <a wireNavigate href="{{ $url }}" class="px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a wireNavigate href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                     {{ __('Next') }} →
                </a>
            @else
                <span class="px-3 py-2 text-gray-400 cursor-not-allowed">{{ __('Next') }} →</span>
            @endif
        </div>
    </nav>
@endif
