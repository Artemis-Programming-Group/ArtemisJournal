@props([
    'title' => null,
    'description' => null,
])

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
    @if($title || $description)
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            @if($title)
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $title }}</h2>
            @endif
            @if($description)
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $description }}</p>
            @endif
        </div>
    @endif

    <div class="px-6 py-4">
        {{ $slot }}
    </div>
</div>
