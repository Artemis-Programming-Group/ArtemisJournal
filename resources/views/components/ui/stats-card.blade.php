@props([
    'label' => null,
    'value' => null,
    'trend' => null,
    'icon' => null,
    'color' => 'blue',
])

@php
    $colors = [
        'blue' => 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400',
        'green' => 'bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-400',
        'red' => 'bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-400',
        'purple' => 'bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-400',
    ];
@endphp

<div class="bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-200 dark:border-gray-700">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ $label }}</h3>
        @if($icon)
            <div class="{{ $colors[$color] }} p-2 rounded-lg">
                <i class="{{ $icon }}"></i>
            </div>
        @endif
    </div>

    <div class="flex items-baseline gap-2">
        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $value }}</p>
        @if($trend)
            <span class="text-sm {{ strpos($trend, '+') !== false ? 'text-green-600' : 'text-red-600' }}">
                {{ $trend }}
            </span>
        @endif
    </div>
</div>
