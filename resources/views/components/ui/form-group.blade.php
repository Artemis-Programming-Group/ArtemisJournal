@props([
    'label' => null,
    'required' => false,
])

<div class="mb-6 p-3 rounded-xl border border-dark dark:border-gray-500 ">
    @if($label)
        <label class="block text font-bold mb-3  text-gray-900 dark:text-gray-100">
            {{ $label }}
            @if($required)
                <span class="text-red-600">*</span>
            @endif
        </label>
    @endif

    <div class="space-y-3">
        {{ $slot }}
    </div>
</div>
