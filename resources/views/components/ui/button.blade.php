@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
    'wire' => false,
    'wireAction' => null,
])

@php
    $baseClasses = 'font-medium rounded-lg transition duration-300 focus:outline-none focus:ring-2 cursor-pointer';

    $variants = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-300',
        'secondary' => 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-600 focus:ring-gray-300',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-300',
        'success' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-300',
        'outline' => 'border-2 border-blue-600 text-blue-600 hover:bg-blue-50 dark:hover:bg-gray-800 focus:ring-blue-300',
    ];

    $sizes = [
        'sm' => 'px-3 py-1 text-sm',
        'md' => 'px-6 py-2 text-base',
        'lg' => 'px-8 py-3 text-lg',
    ];

    $classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size];

    if ($disabled) {
        $classes .= ' opacity-50 cursor-not-allowed';
    }
@endphp

<button
    type="{{ $type }}"
    {{ $wire ? "wire:click=$wireAction" : '' }}
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</button>
