@props([
'src' => null,
'name' => null,
'url' => null,
'size' => 'md',
])

@php
$sizes = [
'sm' => 'w-6 h-6 text-xs',
'md' => 'w-10 h-10 text-sm',
'lg' => 'w-12 h-12 text-base',
'xl' => 'w-16 h-16 text-lg',
];

@endphp

<img
    src="{{ $url }}"
    alt="{{ $name }}"
    {{ $attributes->merge([
            'class' => 'rounded-full object-cover ' . $sizes[$size]
        ]) }}>
