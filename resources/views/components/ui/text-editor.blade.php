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
'defaultEditor' => 'simple', // 'simple' or 'tiptap'
])

@php
$uniqueId = uniqid();
@endphp

<div class="mb-4" x-data="textEditorManager('{{ $uniqueId }}', '{{ $defaultEditor }}', @js(old($name, $value) ?? ''))">
    @if($label)
    <label class="block text-sm font-medium mb-2 text-gray-900 dark:text-gray-100">
        {{ $label }}
        @if($required)
        <span class="text-red-600">*</span>
        @endif
    </label>
    @endif

    <!-- Editor Tabs -->
    <div class="flex border-b border-gray-300 dark:border-gray-600 mb-2">
        <button
            type="button"
            @click="switchEditor('simple')"
            :class="activeEditor === 'simple' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-600 dark:text-gray-400'"
            class="px-4 py-2 font-medium text-sm focus:outline-none transition-colors hover:text-blue-600">
            Simple Editor
        </button>
        <button
            type="button"
            @click="switchEditor('tiptap')"
            :class="activeEditor === 'tiptap' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-600 dark:text-gray-400'"
            class="px-4 py-2 font-medium text-sm focus:outline-none transition-colors hover:text-blue-600">
            Rich Text Editor
        </button>
    </div>

    <!-- Simple Textarea Editor -->
    <div x-show="activeEditor === 'simple'" x-cloak>
        <x-ui.textarea
            :name="$name"
            :placeholder="$placeholder"
            :required="$required"
            :rows="$rows"
            x-model="content"
            class="{{ $error ? 'border-red-500' : '' }}" />
    </div>

    <!-- TipTap Rich Text Editor -->
    <div x-show="activeEditor === 'tiptap'" x-cloak>
        <x-ui.tiptap-editor
            :unique-id="$uniqueId" />
    </div>

    <!-- Hidden textarea to store the content for form submission -->
    <textarea
        :id="'hidden-textarea-' + uniqueId"
        name="{{ $name }}"
        x-model="content"
        {{ $wire ? "wire:model=$name":'' }}
        {{ $required ? 'required' : '' }}
        class="hidden"></textarea>

    @if($error)
    <p class="text-red-600 text-sm mt-1">{{ $error }}</p>
    @elseif($hint)
    <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">{{ $hint }}</p>
    @endif
</div>
