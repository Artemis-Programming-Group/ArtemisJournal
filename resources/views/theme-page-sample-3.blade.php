<x-layouts.app>
    <div class="w-full md:w-1/2 mx-auto">
        <!-- Improved Header CTA Button Component -->
        <div class="my-4"></div>

        <!-- Option 1: Modern Gradient Badge Style -->
        <a wire:navigate href="{{ route('posts.index') }}" class="group relative inline-flex items-center gap-2 px-6 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold text-sm sm:text-base transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
            <i class="ri-sparkles-line group-hover:animate-spin transition-all"></i>
            {{ __('Explore Our Stories') }}
            <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
        </a>

        <div class="my-4"></div>
        <hr>
        <div class="my-4"></div>

        <!-- Option 2: Glassmorphism Style (Recommended) -->
        <a wire:navigate href="{{ route('posts.index') }}" class="group inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-white/10 dark:bg-white/5 backdrop-blur-md border border-white/20 dark:border-white/10 hover:border-white/40 dark:hover:border-white/20 text-gray-900 dark:text-white font-semibold text-sm sm:text-base transition-all duration-300 hover:bg-white/20 dark:hover:bg-white/10">
            <i class="ri-book-open-line"></i>
            {{ __('Discover Articles') }}
            <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
        </a>


        <div class="my-4"></div>
        <hr>
        <div class="my-4"></div>

        <!-- Option 3: Animated Underline Style -->
        <a wire:navigate href="{{ route('posts.index') }}" class="group inline-flex items-center gap-2 text-gray-900 dark:text-white font-semibold text-sm sm:text-base transition-all duration-300">
            <span class="relative">
                {{ __('Browse Our Blog') }}
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-600 to-indigo-600 group-hover:w-full transition-all duration-300"></span>
            </span>
            <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
        </a>


        <div class="my-4"></div>
        <hr>
        <div class="my-4"></div>

        <!-- Option 4: Icon Badge Style (Best for Headers) -->
        <a wire:navigate href="{{ route('posts.index') }}" class="group inline-flex items-center gap-3 px-5 py-2 rounded-full bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800/50 hover:border-blue-400 dark:hover:border-blue-600 transition-all duration-300 hover:shadow-md hover:shadow-blue-200 dark:hover:shadow-blue-900/30">
            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white">
                <i class="ri-book-line text-sm"></i>
            </div>
            <span class="text-gray-900 dark:text-white font-semibold text-sm sm:text-base">
                {{ __('Explore Stories') }}
            </span>
            <i class="ri-arrow-right-line text-blue-600 dark:text-blue-400 group-hover:translate-x-1 transition-transform"></i>
        </a>


        <div class="my-4"></div>
        <hr>
        <div class="my-4"></div>

        <!-- Option 5: Pill Button with Glow Effect -->
        <a wire:navigate href="{{ route('posts.index') }}" class="group relative inline-flex items-center gap-2 px-6 py-2.5 rounded-full font-semibold text-sm sm:text-base text-white overflow-hidden transition-all duration-300">
            <!-- Background gradient -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-600 transition-all duration-300"></div>

            <!-- Hover glow effect -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-400 via-indigo-400 to-blue-400 opacity-0 group-hover:opacity-100 blur transition-opacity duration-300"></div>

            <!-- Content -->
            <div class="relative flex items-center gap-2">
                <i class="ri-lightbulb-flash-line group-hover:animate-bounce"></i>
                {{ __('Read Blog Posts') }}
                <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
            </div>
        </a>


        <div class="my-4"></div>
        <hr>
        <div class="my-4"></div>

        <!-- Option 6: Modern Minimalist -->
        <a wire:navigate href="{{ route('posts.index') }}" class="group inline-flex items-center gap-2 px-4 py-2 text-gray-900 dark:text-white font-semibold text-sm sm:text-base hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-300 border-b-2 border-transparent group-hover:border-blue-600 dark:group-hover:border-blue-400">
            {{ __('Latest Articles') }}
            <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
        </a>


        <div class="my-4"></div>
        <hr>
        <div class="my-4"></div>

        <!-- Option 7: Badge with Notification Dot -->
        <a wire:navigate href="{{ route('posts.index') }}" class="group relative inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-white dark:bg-gray-800 border-2 border-blue-600 dark:border-blue-500 hover:border-blue-700 dark:hover:border-blue-400 text-blue-600 dark:text-blue-400 font-semibold text-sm sm:text-base transition-all duration-300 hover:shadow-lg hover:shadow-blue-200 dark:hover:shadow-blue-900/30">
            <span class="absolute -top-2 -right-2 flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-600"></span>
            </span>
            {{ __('View Blog') }}
            <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
        </a>


        <div class="my-4"></div>
        <hr>
        <div class="my-4"></div>

        <!-- Option 8: Hover Shift Effect (Most Modern) -->
        <a wire:navigate href="{{ route('posts.index') }}" class="group inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold text-sm sm:text-base transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/50 hover:-translate-y-0.5">
            <i class="ri-book-open-line group-hover:rotate-12 transition-transform"></i>
            {{ __('Discover Articles') }}
            <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
        </a>


        <div class="my-4"></div>
        <hr>
        <div class="my-4"></div>

        <!-- RECOMMENDED STYLES FOR HEADER -->

        <!-- For Navigation Header (Clean) -->
        <nav class="flex items-center justify-center gap-8">
            <!-- Option 4: Icon Badge (Best) -->
            <a wire:navigate href="{{ route('posts.index') }}" class="group inline-flex items-center gap-3 px-5 py-2 rounded-full bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800/50 hover:border-blue-400 dark:hover:border-blue-600 transition-all duration-300 hover:shadow-md hover:shadow-blue-200 dark:hover:shadow-blue-900/30">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white">
                    <i class="ri-book-line text-sm"></i>
                </div>
                <span class="text-gray-900 dark:text-white font-semibold text-sm sm:text-base">
                    {{ __('Explore Stories') }}
                </span>
                <i class="ri-arrow-right-line text-blue-600 dark:text-blue-400 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </nav>

        <div class="my-4"></div>
        <hr>
        <div class="my-4"></div>

        <!-- COMPLETE HEADER EXAMPLE -->
        <header class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between py-4">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <i class="ri-code-line text-white"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-900 dark:text-white">Blog</span>
                    </a>

                    <!-- Center CTA (Icon Badge Style) -->
                    <a wire:navigate href="{{ route('posts.index') }}" class="group hidden sm:inline-flex items-center gap-3 px-5 py-2 rounded-full bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800/50 hover:border-blue-400 dark:hover:border-blue-600 transition-all duration-300 hover:shadow-md hover:shadow-blue-200 dark:hover:shadow-blue-900/30">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white">
                            <i class="ri-book-line text-sm"></i>
                        </div>
                        <span class="text-gray-900 dark:text-white font-semibold text-sm">
                            {{ __('Explore Stories') }}
                        </span>
                        <i class="ri-arrow-right-line text-blue-600 dark:text-blue-400 group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <!-- Right Menu -->
                    <div class="flex items-center gap-4">
                        @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            Dashboard
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            Sign In
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

    </div>
</x-layouts.app>
