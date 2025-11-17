<?php

use Livewire\Volt\Component;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

new class extends Component {
    #[\Livewire\Attributes\Computed]
    public function stats()
    {
        return [
            'articles' => Post::published()->count(),
            'writers' => User::whereHas('posts')->count(),
            'readers' => 'N/A', // You can implement reader tracking
            'communities' => 'N/A', // You can add communities model
            'total_reading_time' => Post::published()->sum('reading_time'), // You can add communities model
        ];
    }

    #[\Livewire\Attributes\Computed]
    public function featuredPosts()
    {
        return Post::published()
            ->with('user', 'tags')
            ->latest()
            ->limit(3)
            ->get();
    }
};
?>

<x-slot:style>
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .main-grid {
            display: grid;
            grid-template-rows: 1fr auto;

        }
    </style>
</x-slot:style>

<div class="main-grid h-full">
    <!-- Hero Section -->
    <section class="hero-gradient text-white py-20 sm:py-32 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-20 right-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute -bottom-10 left-20 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl animate-float" style="animation-delay: 3s;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-6">
                    <h1 class="text-5xl sm:text-6xl font-bold leading-tight">
                        {{ __('Share Your') }} <span class="text-transparent bg-clip-text bg-linear-to-r from-yellow-200 to-pink-200">{{ __('Stories') }}</span> {{ __('with the World') }}
                    </h1>
                    <p class="text-xl text-blue-100 leading-relaxed">
                        {{ __('A modern platform for writers, developers, and creators to share knowledge, build communities, and inspire millions.') }}
                    </p>
                    <div class="flex flex-wrap gap-4 pt-4">
                        <a wireNavigate href="{{ route('register') }}" class="px-8 py-3 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition font-bold text-lg flex items-center gap-2 group">
                            <i class="ri-pencil-line group-hover:rotate-12 transition"></i>
                            {{ __('Start Writing') }}
                        </a>
                        <a wireNavigate href="{{ route('posts') }}" class="px-8 py-3 bg-white/20 text-white rounded-lg hover:bg-white/30 transition font-bold text-lg border-2 border-white/50 flex items-center gap-2">
                            <i class="ri-eye-line"></i>
                            {{ __('Explore Articles') }}
                        </a>
                    </div>
                </div>

                <!-- Right Illustration -->
                <div class="hidden lg:flex justify-center">
                    <div class="relative w-80 h-80">
                        <div class="absolute inset-0 bg-linear-to-br from-blue-300/20 to-indigo-300/20 rounded-3xl blur-2xl"></div>
                        <div class="relative w-full h-full rounded-3xl bg-white/90 backdrop-blur-md border border-white/20 flex items-center justify-center">
                            <!-- <i class="ri-quill-pen-line text-8xl text-white/50"></i> -->
                            <img src="/logo.png" alt="{{ getSiteName() }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Stats -->
    <section id="stats" class="bg-white dark:bg-gray-800 py-12 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-blue-600 mb-2">
                        {{ $this->stats['articles'] }}
                    </p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">{{ __('Published Articles') }}</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-green-600 mb-2">
                        {{ $this->stats['writers'] }}
                    </p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">{{ __('Active Writers') }}</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-purple-600 mb-2">
                        {{ $this->stats['readers'] }}
                    </p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">{{ __('Monthly Readers') }}</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-pink-600 mb-2">
                        {{ $this->stats['total_reading_time'] }}
                    </p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">{{ __('Total Reading Time') }}</p>
                </div>
            </div>
        </div>
    </section>
</div>
