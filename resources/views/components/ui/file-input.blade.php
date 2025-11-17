@props([
    'label' => null,
    'name' => null,
    'accept' => null,
    'required' => false,
    'error' => null,
    'hint' => null,
    'wire' => false,
])

<div class="mb-4">
    @if($label)
        <label class="block text-sm font-medium mb-2 text-gray-900 dark:text-gray-100">
            {{ $label }}
            @if($required)
                <span class="text-red-600">*</span>
            @endif
        </label>
    @endif

    <input
        type="file"
        name="{{ $name }}"
        {{ $accept ? "accept=\"$accept\"" : '' }}
        {{ $required ? 'required' : '' }}
        {{ $wire ? "wire:model=$name" : '' }}
        {{ $attributes->merge([
            'class' => 'w-full px-4 py-2 border rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600 ' . ($error ? 'border-red-500' : 'border-gray-300 dark:border-gray-600')
        ]) }}
    >

    @if($error)
        <p class="text-red-600 text-sm mt-1">{{ $error }}</p>
    @elseif($hint)
        <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">{{ $hint }}</p>
    @endif
</div>
