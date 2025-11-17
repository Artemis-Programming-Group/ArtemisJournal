<?php

use Livewire\Volt\Component;
use App\Models\Post;

new class extends Component {
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post->load('user', 'tags', 'comments.user');
    }

    #[\Livewire\Attributes\Computed]
    public function relatedPosts()
    {
        return $this->post->relatedPosts();
    }
};
?>
<x-slot:style>
    <link rel="stylesheet" href="/assets/css/tiny-content-base-style.css">
</x-slot:style>

<div>
    <!-- Navigation -->
    <nav class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 z-40">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <a wireNavigate href="{{ route('posts.index') }}" class="flex items-center gap-2 text-blue-600 hover:text-blue-700">
                <i class="ri-arrow-left-line"></i>
                {{ __('Back to Posts') }}
            </a>
            <div class="flex items-center gap-3">
                @can('update', $post)
                <a href="{{ route('posts.edit', $post) }}" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                    <i class="ri-edit-line text-gray-600 dark:text-gray-400"></i>
                </a>
                @endcan
                <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                    <i class="ri-heart-line text-gray-600 dark:text-gray-400"></i>
                </button>
                <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                    <i class="ri-bookmark-line text-gray-600 dark:text-gray-400"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Article Container -->
    <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Header -->
        <header class="mb-8">
            <div class="mb-4 flex flex-wrap gap-2">
                @foreach($post->tags as $tag)
                <x-ui.badge variant="primary">#{{ $tag->name }}</x-ui.badge>
                @endforeach
            </div>

            <h1 class="text-4xl sm:text-5xl font-bold mb-4 leading-tight">{{ $post->title }}</h1>
            <p class="text-xl text-gray-600 dark:text-gray-400 mb-6">{{ $post->excerpt }}</p>

            <div class="flex items-center justify-between py-6 border-y border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-4">
                    <x-ui.avatar name="{{ $post->user->name }}" size="lg" />
                    <div>
                        <p class="font-semibold">{{ $post->user->name }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Author') }}
                        </p>
                    </div>
                </div>
                <div class="text-right text-sm text-gray-600 dark:text-gray-400">
                    <p>{{ $post->created_at->format('F j, Y') }}</p>
                    <p>{{ $post->reading_time }}</p>
                </div>
            </div>
        </header>

        <!-- Featured Image -->
        @if($post->featured_image)
        <div class="my-12 aspect-video rounded-xl overflow-hidden">
            <img src="{{ asset('upload/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
        @endif

        <!-- Pricing -->
        @if($post->price)
        <div class="my-8 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6">
            <div class="flex items-center gap-4">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
                        {{ __('Price') }}
                    </p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-blue-600">${{ number_format($post->price / 100, 2) }}</span>
                        @if($post->old_price)
                        <span class="text-lg text-gray-400 line-through">${{ number_format($post->old_price / 100, 2) }}</span>
                        <x-ui.badge variant="danger">{{ $post->discount_percentage }}% {{ __('OFF') }}</x-ui.badge>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Main Content -->
        <section class="tinymce-content prose dark:prose-invert max-w-none mb-12">
            {!! $post->content !!}
        </section>

        <!-- Related Posts -->
        @if($this->relatedPosts->count())
        <section class="my-12">
            <h2 class="text-3xl font-bold mb-6">
                {{ __('Related Articles') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($this->relatedPosts as $related)
                <a wireNavigate href="{{ route('posts.show', $related) }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow block group">
                    @if($related->featured_image)
                    <img src="{{ asset('upload/' . $related->featured_image) }}" alt="{{ $related->title }}" class="aspect-video object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                    <div class="aspect-video bg-linear-to-br from-green-400 to-blue-400 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                        <i class="ri-file-text-line text-white text-5xl opacity-30"></i>
                    </div>
                    @endif
                    <div class="p-4">
                        <h3 class="font-semibold mb-2 line-clamp-2">{{ $related->title }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">{{ $related->excerpt }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span>{{ $related->user->name }}</span>
                            <span>{{ $related->reading_time }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        @endif

        <!-- Comments Section -->
        <livewire:comments.section :commentable="$post" />
    </article>
</div>
