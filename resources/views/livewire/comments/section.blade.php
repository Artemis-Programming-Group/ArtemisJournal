<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

new class extends Component {
    use WithPagination;

    public Model $commentable;
    public int $perPage = 5;
    public bool $showForm = false;
    public string $newComment = '';

    public function mount(Model $commentable): void
    {
        $this->commentable = $commentable;
    }

    #[\Livewire\Attributes\Computed]
    public function comments()
    {
        return $this->commentable
            ->comments()
            ->with('user')
            ->latest()
            ->paginate($this->perPage);
    }

    #[\Livewire\Attributes\Computed]
    public function totalComments()
    {
        return $this->commentable->comments()->count();
    }

    public function addComment(): void
    {
        $this->validate([
            'newComment' => 'required|string|min:3|max:1000',
        ], [
            'newComment.required' => __('Please write a comment.'),
            'newComment.min' => __('Comment must be at least 3 characters.'),
            'newComment.max' => __('Comment must not exceed 1000 characters.'),
        ]);

        Comment::create([
            'content' => $this->newComment,
            'user_id' => auth()->id(),
            'commentable_id' => $this->commentable->id,
            'commentable_type' => $this->commentable::class,
        ]);

        $this->newComment = '';
        $this->showForm = false;
        $this->resetPage();
        session()->flash('comment-success', __('Comment posted successfully!'));
    }

    public function deleteComment(Comment $comment): void
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        session()->flash('comment-deleted', __('Comment deleted successfully!'));
    }

    public function toggleForm(): void
    {
        $this->showForm = !$this->showForm;
        $this->newComment = '';
    }
};
?>

<section class="my-12">
    <!-- Header with Count -->
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
            <i class="ri-chat-3-line text-blue-600"></i>
            {{ __('Comments') }}
            <span class="text-lg bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full font-semibold">
                {{ $this->totalComments }}
            </span>
        </h2>

        @auth
        @if(!$showForm)
        <button
            wire:click="toggleForm"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
            <i class="ri-add-line"></i>
            {{ __('Add Comment') }}
        </button>
        @endif
        @endauth
    </div>

    <!-- Alert Messages -->
    @if (session('comment-success'))
    <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 animate-pulse">
        <div class="flex gap-3">
            <i class="ri-check-circle-line text-green-600 dark:text-green-400 text-xl shrink-0 mt-0.5"></i>
            <div>
                <h3 class="font-semibold text-green-800 dark:text-green-200">{{ __('Success!') }}</h3>
                <p class="text-sm text-green-700 dark:text-green-300">{{ session('comment-success') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if (session('comment-deleted'))
    <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 animate-pulse">
        <div class="flex gap-3">
            <i class="ri-delete-bin-line text-red-600 dark:text-red-400 text-xl shrink-0 mt-0.5"></i>
            <div>
                <h3 class="font-semibold text-red-800 dark:text-red-200">{{ __('Deleted') }}</h3>
                <p class="text-sm text-red-700 dark:text-red-300">{{ session('comment-deleted') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Comment Form (Collapsible) -->
    @auth
    <div class="mb-8 transition-all duration-300">
        @if($showForm)
        <x-ui.form-card title="{{ __('Add Your Comment') }}" description="{{ __('Share your thoughts') }}">
            <form wire:submit="addComment" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                        {{ __('Your Comment') }}
                    </label>
                    <textarea
                        wire:model.lazy="newComment"
                        rows="4"
                        placeholder="{{ __('Share your thoughts on this post...') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 resize-none transition"></textarea>
                    @error('newComment')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                        <i class="ri-alert-circle-line"></i>
                        {{ $message }}
                    </p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">
                        <i class="ri-information-line me-1"></i>
                        {{ strlen($newComment) }}/{{ __('1000 characters') }}
                    </p>
                </div>

                <div class="flex gap-3 pt-2">
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-50 cursor-not-allowed"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center gap-2 font-medium">
                        <i class="ri-send-plane-line"></i>
                        <span wire:loading.remove>
                            {{ __('Post Comment') }}
                        </span>
                        <span wire:loading>
                            <i class="ri-loader-4-line animate-spin"></i>
                        </span>
                    </button>
                    <button
                        type="button"
                        wire:click="toggleForm"
                        class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition font-medium">
                        {{ __('Cancel') }}
                    </button>
                </div>
            </form>
        </x-ui.form-card>
        @else
        <div class="bg-blue-50 dark:bg-blue-900/20 border-2 border-dashed border-blue-200 dark:border-blue-800 rounded-lg p-6 text-center cursor-pointer hover:bg-blue-100 dark:hover:bg-blue-900/30 transition"
            wire:click="toggleForm">
            <i class="ri-chat-smile-line text-3xl text-blue-600 mb-2"></i>
            <p class="text-blue-900 dark:text-blue-200 font-medium">
                {{ __('What do you think?') }} <span class="text-blue-600 hover:underline">{{ __('Share your comment') }}</span>
            </p>
        </div>
        @endif
    </div>
    @else
    <div class="mb-8 bg-linear-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border-2 border-blue-200 dark:border-blue-800 rounded-lg p-6">
        <div class="flex items-center gap-4">
            <i class="ri-login-box-line text-3xl text-blue-600"></i>
            <div>
                <p class="text-blue-900 dark:text-blue-200 font-semibold mb-2">
                    {{ __('Join the conversation!') }}
                </p>
                <p class="text-sm text-blue-800 dark:text-blue-300 mb-3">
                    <a wireNavigate href="{{ route('login') }}" class="font-semibold text-blue-600 dark:text-blue-400 hover:underline">
                        {{ __('Sign in') }}
                    </a>
                    {{ __('to share your thoughts on this article.') }}
                </p>
                <a wireNavigate href="{{ route('register') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 dark:text-blue-400 hover:underline">
                    {{ __('Don\'t have an account?') }} <i class="ri-arrow-right-line"></i>
                </a>
            </div>
        </div>
    </div>
    @endauth

    <!-- Comments List -->
    @if($this->comments->count())
    <div class="space-y-4 mb-8">
        @foreach($this->comments as $comment)
        <div
            class="bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-200 dark:border-gray-700 hover:border-blue-300 dark:hover:border-blue-600 transition group"
            wire:key="comment-{{ $comment->id }}">
            <!-- Comment Header -->
            <div class="flex items-start gap-4 mb-4">
                <!-- Avatar -->
                <a wireNavigate href="#" class="shrink-0 transition">
                    <img
                        src="{{ $comment->user->avatar_url }}"
                        alt="{{ $comment->user->name }}"
                        class="w-10 h-10 rounded-full object-cover border-2 border-gray-200 dark:border-gray-700 group-hover:border-blue-400 transition">
                </a>

                <!-- User Info -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <p class="font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                            {{ $comment->user->name }}
                        </p>
                        @if($comment->user->id === auth()->id())
                        <span class="text-xs bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-2 py-0.5 rounded-full">
                            {{ __('You') }}
                        </span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2">
                        <i class="ri-time-line"></i>
                        {{ $comment->created_at->diffForHumans() }}
                    </p>
                </div>

                <!-- Delete Button -->
                @can('delete', $comment)
                <button
                    wire:click="deleteComment({{ $comment->id }})"
                    wire:confirm="Are you sure you want to delete this comment?"
                    class="text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition opacity-0 group-hover:opacity-100"
                    title="Delete comment">
                    <i class="ri-delete-bin-line text-xl"></i>
                </button>
                @endcan
            </div>

            <!-- Comment Content -->
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed wrap-break-word">
                {{ $comment->content }}
            </p>

            <!-- Comment Footer -->
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 flex items-center gap-4 text-sm">
                <button class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition flex items-center gap-1">
                    <i class="ri-thumb-up-line"></i>
                    <span>{{ __('Like') }}</span>
                </button>
                <button class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition flex items-center gap-1">
                    <i class="ri-reply-line"></i>
                    <span>{{ __('Reply') }}</span>
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($this->comments->hasPages())
    <div class="mt-8">
        {{ $this->comments->links('components.ui.pagination') }}
    </div>
    @endif
    @else
    <!-- No Comments State -->
    <div class="bg-white dark:bg-gray-800 rounded-lg p-12 text-center border-2 border-dashed border-gray-200 dark:border-gray-700">
        <i class="ri-chat-off-line text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
            {{ __('No comments yet') }}
        </h3>
        <p class="text-gray-600 dark:text-gray-400 mb-6">
           {{ __(' Be the first to share your thoughts on this article.') }}
        </p>
        @auth
        <button
            wire:click="toggleForm"
            class="inline-flex items-center gap-2 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
            <i class="ri-add-line"></i>
            {{ __('Start the Conversation') }}
        </button>
        @else
        <div class="space-y-3">
            <p class="text-gray-600 dark:text-gray-400">
                <a wireNavigate href="{{ route('login') }}" class="font-semibold text-blue-600 dark:text-blue-400 hover:underline">
                    {{ __('Sign in') }}
                </a>
                {{ __('to comment') }}
            </p>
        </div>
        @endauth
    </div>
    @endif
</section>
