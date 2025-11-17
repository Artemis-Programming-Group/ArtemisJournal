@props([
    'type' => 'info',
    'title' => null,
    'dismissible' => true,
])

@php
    $types = [
        'success' => [
            'bg' => 'bg-green-50 dark:bg-green-900/20',
            'border' => 'border-green-200 dark:border-green-800',
            'title' => 'text-green-900 dark:text-green-200',
            'text' => 'text-green-800 dark:text-green-300',
            'icon' => 'ri-check-circle-line text-green-600 dark:text-green-400',
        ],
        'error' => [
            'bg' => 'bg-red-50 dark:bg-red-900/20',
            'border' => 'border-red-200 dark:border-red-800',
            'title' => 'text-red-900 dark:text-red-200',
            'text' => 'text-red-800 dark:text-red-300',
            'icon' => 'ri-error-warning-line text-red-600 dark:text-red-400',
        ],
        'warning' => [
            'bg' => 'bg-yellow-50 dark:bg-yellow-900/20',
            'border' => 'border-yellow-200 dark:border-yellow-800',
            'title' => 'text-yellow-900 dark:text-yellow-200',
            'text' => 'text-yellow-800 dark:text-yellow-300',
            'icon' => 'ri-alert-line text-yellow-600 dark:text-yellow-400',
        ],
        'info' => [
            'bg' => 'bg-blue-50 dark:bg-blue-900/20',
            'border' => 'border-blue-200 dark:border-blue-800',
            'title' => 'text-blue-900 dark:text-blue-200',
            'text' => 'text-blue-800 dark:text-blue-300',
            'icon' => 'ri-information-line text-blue-600 dark:text-blue-400',
        ],
    ];

    $config = $types[$type];
@endphp

<div
    x-data="{ open: true }"
    x-show="open"
    class="{{ $config['bg'] }} {{ $config['border'] }} border rounded-lg p-4 flex gap-3"
>
    <div class="flex-shrink-0">
        <i class="{{ $config['icon'] }} text-xl"></i>
    </div>

    <div class="flex-1">
        @if($title)
            <h3 class="font-semibold {{ $config['title'] }}">{{ $title }}</h3>
        @endif
        <div class="text-sm {{ $config['text'] }} {{ $title ? 'mt-1' : '' }}">
            {{ $slot }}
        </div>
    </div>

    @if($dismissible)
        <button
            @click="open = false"
            class="flex-shrink-0 {{ $config['text'] }} hover:opacity-75"
        >
            <i class="ri-close-line text-xl"></i>
        </button>
    @endif
</div>


