@props([
    'name' => null,
    'value' => null,
    'label' => null,
    'checked' => false,
    'error' => null,
])

<div class="mb-3">
    <label class="flex items-center">
        <input
            type="checkbox"
            name="{{ $name }}"
            value="{{ $value }}"
            {{ (is_array(old($name)) ? in_array($value, old($name)) : old($name) == $value) || $checked ? 'checked' : '' }}
            {{ $attributes->merge([
                'class' => 'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-offset-gray-100 dark:bg-gray-700 dark:border-gray-600'
            ]) }}
        >
        <span class="ms-2 text-gray-900 dark:text-gray-100">{{ $label }}</span>
    </label>
    @if($error)
        <p class="text-red-600 text-sm mt-1">{{ $error }}</p>
    @endif
</div>
