@props([
    'label' => null,
    'name' => null,
    'value' => null,
    'placeholder' => 'Add tags...',
    'required' => false,
    'error' => null,
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

    <div
        x-data="{
            tags: {{ json_encode(is_array($value) ? $value : []) }},
            input: '',
            addTag() {
                if(this.input.trim() && !this.tags.includes(this.input.trim())) {
                    this.tags.push(this.input.trim());
                    this.input = '';
                }
            },
            removeTag(index) {
                this.tags.splice(index, 1);
            }
        }"
        class="space-y-2"
    >
        <!-- Tags Display -->
        <div class="flex flex-wrap gap-2 mb-2">
            <template x-for="(tag, index) in tags" :key="index">
                <div class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-sm flex items-center gap-2">
                    <span x-text="tag"></span>
                    <button
                        type="button"
                        @click="removeTag(index)"
                        class="hover:text-blue-600"
                    >
                        <i class="ri-close-line text-lg"></i>
                    </button>
                </div>
            </template>
        </div>

        <!-- Input -->
        <input
            type="text"
            x-model="input"
            @keydown.enter.prevent="addTag()"
            @keydown.comma.prevent="addTag()"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge([
                'class' => 'w-full px-4 py-2 border rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600 border-gray-300 dark:border-gray-600'
            ]) }}
        >

        <!-- Hidden Input for Form Submission -->
        <input type="hidden" :value="tags.join(',')" name="{{ $name }}">
    </div>

    @if($error)
        <p class="text-red-600 text-sm mt-1">{{ $error }}</p>
    @endif
</div>
