@props([
'post' => null,
'action' => null,
'tags' => [],
'wire' => false,
'wireAction' => null
])

@php
$isEdit = $post !== null;
$formAction = $wire ? '' : ($action ?? ($isEdit ? route('posts.update', $post) : route('posts.store')));
$formMethod = $wire ? '' : ($isEdit ? 'PUT' : 'POST');
$buttonType = $wire ? 'button' : 'submit';

@endphp

<x-ui.form-card
    :title="$isEdit ? __('Edit Post') : __('Create New Post')"
    :description="$isEdit ? __('Update your post details') : __('Write and publish your new article')">
    <form method="POST" action="{{ $formAction }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($isEdit)
        @method($formMethod)
        @endif

        <!-- Basic Information -->
        <x-ui.form-group label="{{ __('Basic Information') }}" required>
            <x-ui.input
                name="title"
                label="{{ __('Post Title') }}"
                placeholder="{{ __('Enter an engaging title') }}"
                :value="old('title', $post?->title)"
                required
                :wire="$wire"
                error="{{ $errors->first('title') }}" />

            <x-ui.textarea
                name="excerpt"
                label="{{ __('Excerpt') }}"
                rows="3"
                placeholder="{{ __('Brief summary of your post (appears in listings)') }}"
                :value="old('excerpt', $post?->excerpt)"
                required
                :wire="$wire"
                error="{{ $errors->first('excerpt') }}" />
        </x-ui.form-group>

        <!-- Content -->
        <x-ui.form-group label="{{ __('Content') }}" required>
            <x-ui.textarea
                class="tiny-editor"
                name="content"
                label="{{ __('Post Content') }}"
                rows="12"
                placeholder="{{ __('Write your post content here...') }}"
                :value="old('content', $post?->content)"
                required
                :wire="$wire"
                error="{{ $errors->first('content') }}"
                hint="{{ __('You can use HTML and Markdown') }}" />

        </x-ui.form-group>

        <!-- Media -->
        <x-ui.form-group label="{{ __('Media') }}">
            @if($post?->featured_image)
            <div class="mb-4">
                <img src="{{ asset('upload/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-32 object-cover rounded-lg">
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Current image</p>
            </div>
            @endif

            <x-ui.file-input
                name="featured_image"
                label="{{ __('Featured Image') }}"
                accept="image/*"
                hint="{{ __('Max 2MB. JPG, PNG recommended') }}"
                :wire="$wire"
                error="{{ $errors->first('featured_image') }}" />
        </x-ui.form-group>

        <!-- Pricing -->
        <x-ui.form-group label="{{ __('Pricing (Optional)') }}">
            <div class="grid grid-cols-2 gap-4">
                <x-ui.input
                    name="price"
                    type="number"
                    label="{{ __('Price') }}"
                    placeholder="0"
                    :wire="$wire"
                    :value="old('price', $post?->price)"
                    min="0"
                    error="{{ $errors->first('price') }}" />

                <x-ui.input
                    name="old_price"
                    type="number"
                    label="{{ __('Original Price (for discount)') }}"
                    :wire="$wire"
                    placeholder="0"
                    :value="old('old_price', $post?->old_price)"
                    min="0"
                    error="{{ $errors->first('old_price') }}" />
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                {{ __('Leave empty if not selling') }}
            </p>
        </x-ui.form-group>

        <!-- Organization -->
        <x-ui.form-group label="{{ __('Organization') }}">
            <x-ui.checkbox-group
                name="tags"
                label="{{ __('Tags') }}"
                :wire="$wire"
                :options="$this->existingTags->pluck('name', 'id')->toArray()"
                :values="old('tags', $post?->tags->pluck('id')->toArray() ?? [])"
                error="{{ $errors->first('tags') }}" />

            <x-ui.input
                name="reading_time"
                label="{{ __('Reading Time (minute)') }}"
                :wire="$wire"
                type="number"
                :value="old('reading_time', $post?->reading_time)"
                :required="true"
                error="{{ $errors->first('reading_time') }}" />
        </x-ui.form-group>

        <!-- Status -->
        <x-ui.form-group label="{{ __('Publish Settings') }}" required>
            <x-ui.radio-group
                name="status"
                label="{{ __('Post Status') }}"
                :wire="$wire"
                :options="['draft' => __('Draft'), 'published' => __('Published')]"
                :value="old('status', $post?->status ?? 'draft')"
                required
                error="{{ $errors->first('status') }}" />
        </x-ui.form-group>

        <!-- Actions -->
        <div class="flex gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            <x-ui.button wire:click="{{ $wireAction }}" :type="$buttonType" variant="primary">
                <i class="ri-check-line me-2"></i>
                {{ $isEdit ? __('Update Post') : __('Publish Post') }}
            </x-ui.button>
            <x-ui.button type="button" variant="secondary" onclick="window.history.back()">
                {{ __('Cancel') }}
            </x-ui.button>
            @if($isEdit)
            <x-ui.button
                type="button"
                variant="danger"
                onclick="if(confirm('Are you sure?')) document.getElementById('delete-form').submit()"
                class="ml-auto">
                <i class="ri-delete-bin-line me-2"></i>
                {{ __('Delete') }}
            </x-ui.button>
            @endif
        </div>
    </form>

    @if($isEdit)
    <form id="delete-form" method="POST" action="{{ route('posts.destroy', $post) }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>
    @endif
</x-ui.form-card>
