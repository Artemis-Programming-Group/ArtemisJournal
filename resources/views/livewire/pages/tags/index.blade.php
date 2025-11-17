<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Tag;

new class extends Component {
    use WithPagination;

    public string $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[\Livewire\Attributes\Computed]
    public function tags()
    {
        return Tag::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(12);
    }

    public function deleteTag(Tag $tag)
    {
        $tag->delete();
        session()->flash('message', 'Tag deleted successfully');
    }
};
?>

<div>
    <!-- Navigation -->
    <nav class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-blue-600">{{ __('Tags') }}</h1>
            @auth
            <a href="{{ route('tags.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition" wire:navigate>
                <i class="ri-add-line me-1"></i>
                {{ __('New Tag') }}
            </a>
            @endauth
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Search -->
        <div class="mb-8">
            <input
                type="text"
                wire:model.live="search"
                placeholder="Search tags..."
                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>

        <!-- Tags Grid -->
        @if($this->tags->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($this->tags as $tag)
            <x-ui.card>
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-lg">{{ $tag->name }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $tag->posts_count ?? 0 }} {{ __('posts') }}</p>
                    </div>
                    <div class="flex gap-2">
                        @can('update' , $tag)
                        <a wire:navigate href="{{ route('tags.edit', $tag) }}" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                            <i class="ri-edit-line text-gray-600"></i>
                        </a>
                        @endcan
                        @can('delete' , $tag)
                        <button wire:click="deleteTag({{ $tag->id }})" onclick="confirm('Delete this tag?') || event.stopImmediatePropagation()" class="p-2 hover:bg-red-100 dark:hover:bg-red-900 rounded">
                            <i class="ri-delete-bin-line text-red-600"></i>
                        </button>
                        @endcan
                    </div>
                </div>
            </x-ui.card>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $this->tags->links('components.ui.pagination') }}
        </div>
        @else
        <div class="text-center py-12">
            <i class="ri-bookmark-line text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
            <p class="text-xl text-gray-600 dark:text-gray-400">
                {{ __('No tags found.') }}
            </p>
        </div>
        @endif
    </div>
</div>
