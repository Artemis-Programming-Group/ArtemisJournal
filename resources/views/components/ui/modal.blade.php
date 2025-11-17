@props([
    'id' => 'modal',
    'title' => null,
    'size' => 'md',
])

@php
    $sizes = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
    ];
@endphp

<div
    x-data="{ open: false }"
    @open-{{ $id }}.window="open = true"
    @close-{{ $id }}.window="open = false"
>
    <!-- Backdrop -->
    <div
        x-show="open"
        x-transition
        @click="open = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-40"
    ></div>

    <!-- Modal -->
    <div
        x-show="open"
        x-transition
        @click.stop
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
    >
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl {{ $sizes[$size] }} w-full overflow-hidden">
            @if($title)
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $title }}</h2>
                    <button
                        @click="open = false"
                        class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100"
                    >
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>
            @endif

            <div class="px-6 py-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
