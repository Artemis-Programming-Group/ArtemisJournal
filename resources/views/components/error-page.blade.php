@props([
'code' => '500',
'title' => 'Server Error',
'message' => 'Something went wrong.',
'description' => 'Please try again later.',
])

<x-layouts.app>
    <x-slot:style>
        <style>
            [x-cloak] {
                display: none;
            }

            .error-animation {
                animation: slideUp 0.6s ease-out;
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .error-code {
                font-size: 150px;
                font-weight: 900;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                line-height: 1;
                letter-spacing: -0.02em;
            }

            .float-animation {
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
        </style>
    </x-slot:style>
    <div class="min-h-screen flex items-center justify-center px-4 py-20">
        <div class="w-full max-w-2xl error-animation">
            <!-- Background Elements -->
            <div class="absolute top-20 right-10 w-72 h-72 bg-blue-400/20 rounded-full blur-3xl float-animation pointer-events-none"></div>
            <div class="absolute bottom-20 left-10 w-96 h-96 bg-indigo-400/20 rounded-full blur-3xl float-animation pointer-events-none" style="animation-delay: 3s;"></div>

            <div class="relative z-10 text-center">
                <!-- Error Code -->
                <div class="error-code mb-4">
                    {{ $code }}
                </div>

                <!-- Error Title -->
                <h1 class="text-4xl sm:text-5xl font-bold mb-4">
                    {{ __($title) }}
                </h1>

                <!-- Error Message -->
                <p class="text-xl text-gray-600 dark:text-gray-400 mb-6 max-w-lg mx-auto">
                    {{ __($message) }}
                </p>

                <!-- Error Description -->
                <p class="text-base text-gray-500 dark:text-gray-500 mb-12 max-w-lg mx-auto">
                    {{ __($description) }}
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ route('home') }}" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-bold flex items-center gap-2 group">
                        <i class="ri-home-line group-hover:translate-x-1 transition"></i>
                        {{ __('Back to Home') }}
                    </a>
                    <a href="{{ route('posts') }}" class="px-8 py-3 border-2 border-blue-600 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition font-bold flex items-center gap-2 group">
                        <i class="ri-book-line group-hover:translate-x-1 transition"></i>
                        {{ __('Browse Blog') }}
                    </a>
                    @auth
                    <a href="{{ route('dashboard') }}" class="px-8 py-3 border-2 border-purple-600 text-purple-600 dark:text-purple-400 rounded-lg hover:bg-purple-50 dark:hover:bg-purple-900/20 transition font-bold flex items-center gap-2 group">
                        <i class="ri-dashboard-line group-hover:translate-x-1 transition"></i>
                        {{ __('Dashboard') }}
                    </a>
                    @endauth
                </div>

                <!-- Support Link -->
                <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        {{ __('Need help?') }}
                    </p>
                    <a href="alireza.hadizadeh25@yahoo.com" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-semibold">
                        {{ __('Contact Support') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
