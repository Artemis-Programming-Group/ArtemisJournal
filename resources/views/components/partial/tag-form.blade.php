@props([
'tag' => null,
'wire' => false,
'wireAction' => null,
])

@php
$isEdit = $tag !== null;
$formAction = $wire ? '' : ($isEdit ? route('tags.update', $tag) : route('tags.store'));
$formMethod = $wire ? '' : ($isEdit ? 'PUT' : 'POST');
$buttonType = $wire ? 'button' : 'submit';
@endphp

<x-ui.form-card :title="$isEdit ? __('Edit Tag') : __('Create New Tag')">

    @session('success')
    <div class="mb-4">
        <x-ui.alert type="success" title="{{ __('success') }}" class="mb-3">
            {{ session('success') }}
        </x-ui.alert>
    </div>
    @endsession
    <form method="POST" action="{{ $formAction }}" class="space-y-4">
        @csrf
        @if($isEdit && !$wire)
        @method($formMethod)
        @endif

        <x-ui.input
            name="name"
            label="{{ __('Tag Name') }}"
            placeholder="{{ __('e.g., JavaScript') }}"
            :value="old('name', $tag?->name)"
            required
            :error="$errors->first('name')"
            :wire="$wire"
            wireName="name" />

        <div class="flex gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            <x-ui.button
                type="{{ $buttonType }}"
                variant="primary"
                :wire="$wire"
                :wireAction="$wireAction">
                {{ $isEdit ? __('Update Tag') : __('Create Tag') }}
            </x-ui.button>

            <x-ui.button type="button" variant="secondary" onclick="window.history.back()">
                {{ __('Cancel') }}
            </x-ui.button>
        </div>
    </form>
</x-ui.form-card>
