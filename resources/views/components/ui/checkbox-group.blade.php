@props([
    'label' => null,
    'name' => null,
    'options' => [],
    'values' => [],
    'error' => null,
    'required' => false,
    'wire' => false,

])

<div class="mb-4">
    @if($label)
        <label class="block text-sm font-medium mb-3 text-gray-900 dark:text-gray-100">
            {{ $label }}
            @if($required)
                <span class="text-red-600">*</span>
            @endif
        </label>
    @endif

    <div class="space-y-2">
        @foreach($options as $optionValue => $optionLabel)
            <label class="flex items-center">
                <input
                    type="checkbox"
                    name="{{ $name }}[]"
                    value="{{ $optionValue }}"
                    {{ $wire ? "wire:model=$name":'' }}
                    {{ (is_array(old($name, $values)) && in_array($optionValue, old($name, $values))) ? 'checked' : '' }}
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600"
                >
                <span class="ms-2 text-sm text-gray-900 dark:text-gray-100">{{ $optionLabel }}</span>
            </label>
        @endforeach
    </div>

    @if($error)
        <p class="text-red-600 text-sm mt-2">{{ $error }}</p>
    @endif
</div>
