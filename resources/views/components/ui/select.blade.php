@props([
    'label' => null,
    'name' => null,
    'options' => [],
    'value' => null,
    'placeholder' => 'Select an option',
    'required' => false,
    'error' => null,
    'multiple' => false,
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

    <select
        name="{{ $multiple ? $name . '[]' : $name }}"
        {{ $required ? 'required' : '' }}
        {{ $multiple ? 'multiple' : '' }}
        {{ $attributes->merge([
            'class' => 'w-full px-4 py-2 border rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600 ' . ($error ? 'border-red-500' : 'border-gray-300 dark:border-gray-600')
        ]) }}
    >
        @unless($multiple)
            <option value="">{{ $placeholder }}</option>
        @endunless

        @foreach($options as $optionValue => $optionLabel)
            <option
                value="{{ $optionValue }}"
                {{ (is_array(old($name, $value)) ? in_array($optionValue, old($name, $value)) : old($name, $value) == $optionValue) ? 'selected' : '' }}
            >
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

    @if($error)
        <p class="text-red-600 text-sm mt-1">{{ $error }}</p>
    @endif
</div>
