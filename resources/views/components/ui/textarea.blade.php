@props([
    'label' => null,
    'name' => null,
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'wire' => false,
    'error' => null,
    'rows' => 4,
    'hint' => null,
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

    <textarea
        name="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $wire ? "wire:model=$name":'' }}
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' => 'w-full px-4 py-2 border rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 resize-none ' . ($error ? 'border-red-500' : 'border-gray-300 dark:border-gray-600')
        ]) }}
    >{{ old($name, $value) }}</textarea>

    @if($error)
        <p class="text-red-600 text-sm mt-1">{{ $error }}</p>
    @elseif($hint)
        <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">{{ $hint }}</p>
    @endif
</div>
