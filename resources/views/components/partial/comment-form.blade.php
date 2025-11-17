@props([
'comment' => null,
'commentable' => null,
])

@php
$isEdit = $comment !== null;
$formAction = $isEdit
? route('comments.update', $comment)
: route('comments.store', ['commentable' => $commentable->id]);
$formMethod = $isEdit ? 'PUT' : 'POST';
@endphp

<x-form-card :title="$isEdit ? __('Edit Comment') : __('Add a Comment')">
    <form method="POST" action="{{ $formAction }}" class="space-y-4">
        @csrf
        @if($isEdit)
        @method($formMethod)
        @endif

        <x-textarea
            name="content"
            label="{{ __('Comment') }}"
            rows="4"
            placeholder="{{ __('Share your thoughts...') }}"
            :value="old('content', $comment?->content)"
            required
            error="{{ $errors->first('content') }}" />

        <div class="flex gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            <x-button type="submit" variant="primary">
                {{ $isEdit ? __('Update Comment') : __('Post Comment') }}
            </x-button>
            <x-button type="button" variant="secondary" onclick="window.history.back()">
                {{ __('Cancel') }}
            </x-button>
        </div>
    </form>
</x-form-card>
