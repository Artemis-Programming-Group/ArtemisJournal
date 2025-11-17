<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Url;

new class extends Component {
    use WithPagination;

    public string $search = '';
    public ?int $selectedTag = null;
    public int $perPage = 9;

    #[Url]
    public $status = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedTag()
    {
        $this->resetPage();
    }

    #[\Livewire\Attributes\Computed]
    public function posts()
    {
        $status = ($this->status) ? $this->status : 'published';
        return Post::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('excerpt', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedTag, function ($query) {
                $query->whereHas('tags', function ($q) {
                    $q->where('tag_id', $this->selectedTag);
                });
            })
            ->where('status',  $status)
            ->with('user', 'tags')
            ->latest()
            ->paginate($this->perPage);
    }

    #[\Livewire\Attributes\Computed]
    public function tags()
    {
        return Tag::all();
    }
};
?>

<div>
    <!-- Navigation -->
    <nav class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-blue-600">{{ __('Blog') }}</h1>
            @auth
            <a wireNavigate href="{{ route('posts.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <i class="ri-add-line me-1"></i>
                {{ __('New Post') }}
            </a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-linear-to-r from-blue-600 to-blue-800 text-white py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl font-bold mb-4">{{ __('Explore Stories & Articles') }}</h2>
            <p class="text-lg text-blue-100 mb-6">{{ __('Discover insights on web development, coding tips, and best practices') }}</p>

            <div class="relative max-w-md">
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Search posts..."
                    class="w-full px-4 py-3 rounded-lg text-gray-900 bg-white focus:outline-none focus:ring-2 focus:ring-blue-300">
                <i class="ri-search-line absolute right-3 top-3.5 text-gray-400"></i>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-16 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-wrap gap-2">
                <button
                    wire:click="$set('selectedTag', null)"
                    @class([ 'px-4 py-2 rounded-full text-sm font-medium transition' , 'bg-blue-600 text-white'=> !$this->selectedTag,
                    'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 hover:bg-gray-300' => $this->selectedTag,
                    ])
                    >
                    {{ __('All') }}
                </button>
                @foreach($this->tags as $tag)
                <button
                    wire:click="$set('selectedTag', {{ $tag->id }})"
                    @class([ 'px-4 py-2 rounded-full text-sm font-medium transition' , 'bg-blue-600 text-white'=> $this->selectedTag === $tag->id,
                    'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 hover:bg-gray-300' => $this->selectedTag !== $tag->id,
                    ])
                    >
                    {{ $tag->name }}
                </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Posts Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($this->posts->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($this->posts as $post)
            <article class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 group cursor-pointer">
                @if($post->featured_image)
                <a wireNavigate href="{{ route('posts.show', $post->slug) }}" class="block">
                    <img src="{{ asset('upload/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full aspect-video object-cover group-hover:scale-105 transition-transform duration-300">
                </a>
                @else
                <div class="aspect-video bg-linear-to-br from-purple-400 to-pink-400 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                    <i class="ri-code-line text-white text-6xl opacity-30"></i>
                </div>
                @endif

                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-3">
                        @foreach($post->tags as $tag)
                        <x-ui.badge variant="primary" size="sm">#{{ $tag->name }}</x-ui.badge>
                        @endforeach
                    </div>

                    <a wireNavigate href="{{ route('posts.show', $post->slug) }}" class="block">
                        <h3 class="text-xl font-bold mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">{{ $post->title }}</h3>
                    </a>

                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ Str::limit($post->excerpt, 100) }}</p>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <x-ui.avatar url="{{ $post->user->avatar_url }}" name="{{ $post->user->name }}" size="sm" />
                            <div>
                                <p class="text-sm font-medium">{{ $post->user->name }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ __('Reading Time') }}:
                                    {{ $post->reading_time }}
                                </p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $this->posts->links('components.ui.pagination') }}
        </div>
        @else
        <div class="text-center py-12">
            <i class="ri-file-text-line text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
            <p class="text-xl text-gray-600 dark:text-gray-400">
                {{ __('No posts found.') }}
            </p>
        </div>
        @endif
    </div>
</div>
