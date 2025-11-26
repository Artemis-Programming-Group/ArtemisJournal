<header class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 z-40">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ mobileMenuOpen: false }">
        <!-- Desktop & Mobile Header -->
        <div class="py-4 flex items-center justify-between">
            <!-- Logo (Left) -->
            <div class="shrink-0">
                <a wire:navigate href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <h1 class="text-xl sm:text-2xl font-bold bg-linear-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent ">
                        <x-site-name />
                    </h1>
                </a>
            </div>

            <!-- Center CTA (Desktop Only) -->
            @if (!Route::is('posts.index'))
            <div class="hidden md:flex">
                <a wire:navigate href="{{ route('posts') }}" class="group inline-flex items-center gap-3 px-5 py-2 rounded-full bg-linear-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800/50 hover:border-blue-400 dark:hover:border-blue-600 transition-all duration-300 hover:shadow-md hover:shadow-blue-200 dark:hover:shadow-blue-900/30">
                    <div class="w-8 h-8 rounded-full bg-linear-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white">
                        <i class="ri-book-line text-sm"></i>
                    </div>
                    <span class="text-gray-900 dark:text-white font-semibold text-sm">
                        {{ __('Explore Stories') }}
                    </span>
                    <i class="ri-arrow-left-line text-blue-600 dark:text-blue-400 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
            @endif

            <!-- Right Menu (Desktop) -->
            <div class="hidden md:flex items-center gap-3">
                @guest
                <a wire:navigate href="{{ route('register') }}" class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition font-medium">
                    {{ __('Register') }}
                </a>
                <a wire:navigate href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    {{ __('Login') }}
                </a>
                @endguest
                @auth
                @if (!Route::is('dashboard'))
                <a wire:navigate href="{{ route('dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    {{ __('Dashboard') }}
                </a>
                @endif
                <form action="{{ route('logout') }}" method="post" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                        {{ __('Logout') }}
                    </button>
                </form>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button
                @click="mobileMenuOpen = !mobileMenuOpen"
                class="md:hidden p-2 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                :class="mobileMenuOpen ? 'bg-gray-100 dark:bg-gray-700' : ''">
                <i class="ri-menu-line text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div
            x-show="mobileMenuOpen"
            x-transition
            class="md:hidden pb-4 border-t border-gray-200 dark:border-gray-700 mt-4">
            <!-- Mobile CTA -->
            @if (!Route::is('posts.index'))
            <div class="mb-4">
                <a wire:navigate href="{{ route('posts') }}" @click="mobileMenuOpen = false" class="w-full block group px-4 py-3 rounded-lg bg-linear-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800/50 hover:border-blue-400 dark:hover:border-blue-600 transition-all">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-linear-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white shrink-0">
                            <i class="ri-book-line text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <span class="text-gray-900 dark:text-white font-semibold text-sm block">
                                {{ __('Explore Stories') }}
                            </span>
                            <span class="text-gray-600 dark:text-gray-400 text-xs">
                                {{ __('Read amazing articles') }}
                            </span>
                        </div>
                        <i class="ri-arrow-left-line text-blue-600 dark:text-blue-400"></i>
                    </div>
                </a>
            </div>
            @endif

            <!-- Mobile Auth Menu -->
            @guest
            <div class="space-y-2">
                <a wire:navigate href="{{ route('register') }}" @click="mobileMenuOpen = false" class="w-full block px-4 py-3 text-center text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition font-medium">
                    <i class="ri-user-add-line mr-2"></i>
                    {{ __('Register') }}
                </a>
                <a wire:navigate href="{{ route('login') }}" @click="mobileMenuOpen = false" class="w-full block px-4 py-3 text-center bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    <i class="ri-login-box-line mr-2"></i>
                    {{ __('Login') }}
                </a>
            </div>
            @endguest

            @auth
            <div class="space-y-2">
                @if (!Route::is('dashboard'))
                <a wire:navigate href="{{ route('dashboard') }}" @click="mobileMenuOpen = false" class="w-full block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <i class="ri-dashboard-line mr-2"></i>
                    {{ __('Dashboard') }}
                </a>
                @endif

                <form action="{{ route('logout') }}" method="post" class="w-full">
                    @csrf
                    <button type="submit" @click="mobileMenuOpen = false" class="flex flex-start gap-2 w-full  px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition cursor-pinter ">
                        <i class="ri-logout-box-line mr-2"></i>
                        {{ __('Logout') }}
                    </button>
                </form>
            </div>
            @endauth
        </div>
    </nav>
</header>
