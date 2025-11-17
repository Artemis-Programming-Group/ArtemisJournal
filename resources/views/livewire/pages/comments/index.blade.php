<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Comment;

new class extends Component {
    use WithPagination;

    public string $search = '';
    public string $sortBy = 'latest';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[\Livewire\Attributes\Computed]
    public function comments()
    {
        return Comment::query()
            ->where('user_id' , auth()->user()->id)
            ->when($this->search, function ($query) {
                $query->where('content', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->with('user', 'commentable')
            ->when($this->sortBy === 'latest', fn($q) => $q->latest())
            ->when($this->sortBy === 'oldest', fn($q) => $q->oldest())
            ->paginate(10);
    }

    public function deleteComment(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        session()->flash('message', 'Comment deleted successfully');
    }
};
?>

<div>
    <!-- Navigation -->
    <nav class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <h1 class="text-2xl font-bold text-blue-600">{{ __('Comments') }}</h1>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Filters -->
        <div class="flex gap-4 mb-6">
            <input
                type="text"
                wire:model.live="search"
                placeholder="Search comments..."
                class="flex-1 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
            <select
                wire:model.live="sortBy"
                class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                <option value="latest">{{ __('Latest') }}</option>
                <option value="oldest">{{ __('Oldest') }}</option>
            </select>
        </div>

        <!-- Comments List -->
        @if($this->comments->count())
        <div class="space-y-4">
            @foreach($this->comments as $comment)
            <x-ui.card>
                <div class="flex gap-4">
                    <x-ui.avatar name="{{ $comment->user->name }}" size="md" />
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-semibold">{{ $comment->user->name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('on') }} {{ $comment->commentable?->title ?? __('Unknown') }}
                                </p>
                            </div>
                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-700 dark:text-gray-300 mb-3">{{ Str::limit($comment->content, 200) }}</p>
                        <div class="flex gap-2">
                            @if($comment->commentable_type === 'App\Models\Post')
                            <a href="{{ route('posts.show', $comment->commentable) }}" class="text-sm text-blue-600 hover:text-blue-700">
                                {{ __('View Post') }}
                            </a>
                            @endif
                            @can('delete', $comment)
                            <button wire:click="deleteComment({{ $comment->id }})" onclick="confirm('Delete this comment?') || event.stopImmediatePropagation()" class="text-sm text-red-600 hover:text-red-700">
                                Delete
                            </button>
                            @endcan
                        </div>
                    </div>
                </div>
            </x-ui.card>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $this->comments->links('components.ui.pagination') }}
        </div>
        @else
        <div class="text-center py-12">
            <i class="ri-chat-3-line text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
            <p class="text-xl text-gray-600 dark:text-gray-400">{{ __('No comments found.') }}</p>
        </div>
        @endif
    </div>
</div>
