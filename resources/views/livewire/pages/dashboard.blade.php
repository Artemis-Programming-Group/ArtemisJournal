<?php

use Livewire\Volt\Component;
use App\Models\Post;

new class extends Component {
    #[\Livewire\Attributes\Computed]
    public function stats()
    {
        $user = auth()->user();

        return [
            'total_posts' => $user->posts()->count(),
            'published_posts' => $user->posts()->where('status', 'published')->count(),
            'draft_posts' => $user->posts()->where('status', 'draft')->count(),
            'total_comments' => $user->comments()->count(),
        ];
    }

    #[\Livewire\Attributes\Computed]
    public function recentPosts()
    {
        return auth()->user()->posts()->latest()->limit(5)->get();
    }
};
?>

<div>
    <!-- Navigation -->
    <nav class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    <i class="ri-dashboard-line me-2 text-blue-600"></i>{{ __('Dashboard') }}
                </h1>
                <div class="flex items-center gap-4">
                    <a wire:navigate href="{{ route('posts') }}" class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                        <i class="ri-eye-line me-1"></i>{{ __('View Blog') }}
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl font-bold mb-2">{{ __('Welcome back') }}, {{ auth()->user()->name }}! 👋</h2>
            <p class="text-blue-100">{{ __('Here\'s what\'s happening with your blog today') }}</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md border border-gray-200 dark:border-gray-700 hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ __('Total Posts') }}</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $this->stats['total_posts'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                        <i class="ri-file-text-line text-2xl text-blue-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md border border-gray-200 dark:border-gray-700 hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ __('Published') }}</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $this->stats['published_posts'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                        <i class="ri-check-double-line text-2xl text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md border border-gray-200 dark:border-gray-700 hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ __('Drafts') }}</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $this->stats['draft_posts'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center">
                        <i class="ri-file-edit-line text-2xl text-yellow-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md border border-gray-200 dark:border-gray-700 hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ __('Comments') }}</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $this->stats['total_comments'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center">
                        <i class="ri-chat-3-line text-2xl text-purple-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Grid -->
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                <i class="ri-flash-line text-blue-600"></i>
                {{ __('Quick Actions') }}
            </h3>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                <!-- Create Post -->
                <a wire:navigate href="{{ route('posts.create') }}" class="group relative overflow-hidden rounded-xl bg-linear-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 shadow-md hover:shadow-lg transition duration-300 aspect-square flex flex-col items-center justify-center p-6 text-white">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-16 h-16 mx-auto mb-3 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition">
                            <i class="ri-add-circle-line text-3xl"></i>
                        </div>
                        <h4 class="font-semibold text-sm">{{ __('Create Post') }}</h4>
                        <p class="text-xs text-white/80 mt-1">{{ __('Write new article') }}</p>
                    </div>
                </a>

                <!-- Draft Posts -->
                <a wire:navigate href="{{ route('posts.index') }}?status=draft" class="group relative overflow-hidden rounded-xl bg-linear-to-br from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 shadow-md hover:shadow-lg transition duration-300 aspect-square flex flex-col items-center justify-center p-6 text-white">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-16 h-16 mx-auto mb-3 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition">
                            <i class="ri-file-edit-line text-3xl"></i>
                        </div>
                        <h4 class="font-semibold text-sm">{{ __('My Drafts') }}</h4>
                        <p class="text-xs text-white/80 mt-1">{{ $this->stats['draft_posts'] }} {{ __('drafts') }}</p>
                    </div>
                </a>

                <!-- Published Posts -->
                <a wire:navigate href="{{ route('posts.index') }}?status=published" class="group relative overflow-hidden rounded-xl bg-linear-to-br from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 shadow-md hover:shadow-lg transition duration-300 aspect-square flex flex-col items-center justify-center p-6 text-white">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-16 h-16 mx-auto mb-3 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition">
                            <i class="ri-check-double-line text-3xl"></i>
                        </div>
                        <h4 class="font-semibold text-sm">{{ __('Published') }}</h4>
                        <p class="text-xs text-white/80 mt-1">{{ $this->stats['published_posts'] }} {{ __('posts') }}</p>
                    </div>
                </a>

                <!-- All Posts -->
                <a wire:navigate href="{{ route('posts.index') }}" class="group relative overflow-hidden rounded-xl bg-linear-to-br from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 shadow-md hover:shadow-lg transition duration-300 aspect-square flex flex-col items-center justify-center p-6 text-white">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-16 h-16 mx-auto mb-3 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition">
                            <i class="ri-file-list-line text-3xl"></i>
                        </div>
                        <h4 class="font-semibold text-sm">{{ __('All Posts') }}</h4>
                        <p class="text-xs text-white/80 mt-1">{{ __('Manage posts') }}</p>
                    </div>
                </a>

                <!-- Tags -->
                <a wire:navigate href="{{ route('tags.index') }}" class="group relative overflow-hidden rounded-xl bg-linear-to-br from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 shadow-md hover:shadow-lg transition duration-300 aspect-square flex flex-col items-center justify-center p-6 text-white">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-16 h-16 mx-auto mb-3 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition">
                            <i class="ri-bookmark-line text-3xl"></i>
                        </div>
                        <h4 class="font-semibold text-sm">{{ __('Tags') }}</h4>
                        <p class="text-xs text-white/80 mt-1">{{ __('Manage tags') }}</p>
                    </div>
                </a>

                <!-- Comments -->
                <a wire:navigate href="{{ route('comments.index') }}" class="group relative overflow-hidden rounded-xl bg-linear-to-br from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 shadow-md hover:shadow-lg transition duration-300 aspect-square flex flex-col items-center justify-center p-6 text-white">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-16 h-16 mx-auto mb-3 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition">
                            <i class="ri-chat-3-line text-3xl"></i>
                        </div>
                        <h4 class="font-semibold text-sm">{{ __('Comments') }}</h4>
                        <p class="text-xs text-white/80 mt-1">{{ $this->stats['total_comments'] }} {{ __('total') }}</p>
                    </div>
                </a>

                <!-- Profile -->
                <a wire:navigate href="{{ route('profile') }}" class="group relative overflow-hidden rounded-xl bg-linear-to-br from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 shadow-md hover:shadow-lg transition duration-300 aspect-square flex flex-col items-center justify-center p-6 text-white">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-16 h-16 mx-auto mb-3 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition">
                            <i class="ri-user-settings-line text-3xl"></i>
                        </div>
                        <h4 class="font-semibold text-sm">{{ __('Profile') }}</h4>
                        <p class="text-xs text-white/80 mt-1">{{ __('Account settings') }}</p>
                    </div>
                </a>

                <!-- Analytics -->
                <div class="group relative overflow-hidden rounded-xl bg-linear-to-br from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 shadow-md hover:shadow-lg transition duration-300 aspect-square flex flex-col items-center justify-center p-6 text-white cursor-default opacity-50">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-16 h-16 mx-auto mb-3 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition">
                            <i class="ri-bar-chart-line text-3xl"></i>
                        </div>
                        <h4 class="font-semibold text-sm">{{ __('Analytics') }}</h4>
                        <p class="text-xs text-white/80 mt-1">{{ __('Coming soon') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Posts -->
        @if($this->recentPosts->count())
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                <i class="ri-time-line text-blue-600"></i>
                {{ __('Recent Posts') }}
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($this->recentPosts as $post)
                <a wire:navigate href="{{ route('posts.edit', $post) }}" class="group bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md border border-gray-200 dark:border-gray-700 hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-600 transition">
                    @if($post->featured_image)
                    <div class="aspect-video overflow-hidden bg-linear-to-br from-blue-400 to-blue-600">
                        <img src="{{ asset('upload/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    @else
                    <div class="aspect-video bg-linear-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                        <i class="ri-image-add-line text-white text-4xl opacity-30"></i>
                    </div>
                    @endif

                    <div class="p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-semibold text-gray-900 dark:text-white line-clamp-1 group-hover:text-blue-600">{{ $post->title }}</h4>
                            <span @class([ 'text-xs px-2 py-1 rounded-full font-medium' , 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200'=> $post->status === 'published',
                                'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200' => $post->status === 'draft',
                                ])>
                                {{ ucfirst($post->status) }}
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2 mb-3">{{ $post->excerpt }}</p>

                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                            <span>{{ $post->reading_time }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Empty State -->
        @if(!$this->recentPosts->count())
        <div class="bg-white dark:bg-gray-800 rounded-xl p-12 text-center border border-gray-200 dark:border-gray-700">
            <i class="ri-file-text-line text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                {{ __('No posts yet') }}
            </h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                {{ __('Start creating content to see your posts here') }}
            </p>
            <a wire:navigate href="{{ route('posts.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <i class="ri-add-line"></i>
                {{ __(' Create Your First Post') }}
            </a>
        </div>
        @endif
    </div>
</div>
