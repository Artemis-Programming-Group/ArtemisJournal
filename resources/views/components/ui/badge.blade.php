@props([
    'variant' => 'primary',
    'size' => 'md',
])

@php
    $variants = [
        'primary' => 'bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200',
        'secondary' => 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200',
        'success' => 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200',
        'danger' => 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200',
        'warning' => 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200',
    ];

    $sizes = [
        'sm' => 'px-2 py-1 text-xs',
        'md' => 'px-3 py-1 rounded-full text-sm',
        'lg' => 'px-4 py-2 text-base',
    ];
@endphp

<span
    {{ $attributes->merge([
        'class' => 'inline-block rounded-full font-medium ' . $variants[$variant] . ' ' . $sizes[$size]
    ]) }}
>
    {{ $slot }}
</span>
