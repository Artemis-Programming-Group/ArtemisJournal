<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Platform - Share Your Stories</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">

    <style>
        [x-cloak] { display: none; }
        .hero-gradient {
            background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <!-- Navigation -->
    <nav class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 z-50 backdrop-blur-sm bg-opacity-95 dark:bg-opacity-95">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                        <i class="ri-code-line text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Blog</span>
                </a>

                <!-- Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('posts.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition font-medium">
                        Blog
                    </a>
                    <a href="#features" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition font-medium">
                        Features
                    </a>
                    <a href="#stats" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition font-medium">
                        Stats
                    </a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition font-medium">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition font-medium">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

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
                        Share Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 to-pink-200">Stories</span> with the World
                    </h1>
                    <p class="text-xl text-blue-100 leading-relaxed">
                        A modern platform for writers, developers, and creators to share knowledge, build communities, and inspire millions.
                    </p>
                    <div class="flex flex-wrap gap-4 pt-4">
                        <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition font-bold text-lg flex items-center gap-2 group">
                            <i class="ri-pencil-line group-hover:rotate-12 transition"></i>
                            Start Writing
                        </a>
                        <a href="{{ route('posts.index') }}" class="px-8 py-3 bg-white/20 text-white rounded-lg hover:bg-white/30 transition font-bold text-lg border-2 border-white/50 flex items-center gap-2">
                            <i class="ri-eye-line"></i>
                            Explore Articles
                        </a>
                    </div>
                </div>

                <!-- Right Illustration -->
                <div class="hidden lg:flex justify-center">
                    <div class="relative w-80 h-80">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-300/20 to-indigo-300/20 rounded-3xl blur-2xl"></div>
                        <div class="relative w-full h-full rounded-3xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center">
                            <i class="ri-quill-pen-line text-8xl text-white/50"></i>
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
                    <p class="text-3xl sm:text-4xl font-bold text-blue-600 mb-2">5K+</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">Published Articles</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-green-600 mb-2">2.5K+</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">Active Writers</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-purple-600 mb-2">50K+</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">Monthly Readers</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-pink-600 mb-2">100+</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">Communities</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl sm:text-5xl font-bold mb-4">Powerful Features</h2>
                <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto">
                    Everything you need to create, share, and grow your audience
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-600 transition group">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <i class="ri-pencil-line text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Easy Editor</h3>
                    <p class="text-gray-600 dark:text-gray-400">Rich text editor with syntax highlighting for code snippets and beautiful formatting.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-600 transition group">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <i class="ri-share-line text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Easy Sharing</h3>
                    <p class="text-gray-600 dark:text-gray-400">Share your articles across social media and reach a wider audience effortlessly.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-600 transition group">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <i class="ri-chat-3-line text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Community</h3>
                    <p class="text-gray-600 dark:text-gray-400">Connect with readers through comments and build meaningful conversations around your content.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-600 transition group">
                    <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <i class="ri-bookmark-line text-2xl text-pink-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Organization</h3>
                    <p class="text-gray-600 dark:text-gray-400">Tag your articles and organize content with custom categories for better discoverability.</p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-600 transition group">
                    <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <i class="ri-bar-chart-line text-2xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Analytics</h3>
                    <p class="text-gray-600 dark:text-gray-400">Track your article performance and reader engagement with detailed analytics and insights.</p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-600 transition group">
                    <div class="w-12 h-12 bg-cyan-100 dark:bg-cyan-900 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <i class="ri-shield-check-line text-2xl text-cyan-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Secure</h3>
                    <p class="text-gray-600 dark:text-gray-400">Your content is protected with enterprise-grade security and automatic backups daily.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Articles Section -->
    <section class="py-16 sm:py-20 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-4xl sm:text-5xl font-bold mb-2">Featured Articles</h2>
                    <p class="text-gray-600 dark:text-gray-400">Check out the latest from our community</p>
                </div>
                <a href="{{ route('posts.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-bold flex items-center gap-2 transition">
                    View All
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Article Card 1 -->
                <a href="{{ route('posts.index') }}" class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md hover:shadow-xl border border-gray-200 dark:border-gray-700 transition group">
                    <div class="aspect-video bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center group-hover:scale-105 transition">
                        <i class="ri-code-line text-5xl text-white opacity-30"></i>
                    </div>
                    <div class="p-4">
                        <div class="flex gap-2 mb-2">
                            <span class="text-xs px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full">#JavaScript</span>
                            <span class="text-xs px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full">#Tutorial</span>
                        </div>
                        <h3 class="font-bold mb-1 group-hover:text-blue-600">Mastering Async/Await</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Learn advanced async patterns in JavaScript</p>
                        <p class="text-xs text-gray-500">5 min read</p>
                    </div>
                </a>

                <!-- Article Card 2 -->
                <a href="{{ route('posts.index') }}" class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md hover:shadow-xl border border-gray-200 dark:border-gray-700 transition group">
                    <div class="aspect-video bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center group-hover:scale-105 transition">
                        <i class="ri-leaf-line text-5xl text-white opacity-30"></i>
                    </div>
                    <div class="p-4">
                        <div class="flex gap-2 mb-2">
                            <span class="text-xs px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full">#React</span>
                            <span class="text-xs px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full">#Hooks</span>
                        </div>
                        <h3 class="font-bold mb-1 group-hover:text-blue-600">Building Custom Hooks</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Create reusable logic for React components</p>
                        <p class="text-xs text-gray-500">8 min read</p>
                    </div>
                </a>

                <!-- Article Card 3 -->
                <a href="{{ route('posts.index') }}" class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md hover:shadow-xl border border-gray-200 dark:border-gray-700 transition group">
                    <div class="aspect-video bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center group-hover:scale-105 transition">
                        <i class="ri-layout-grid-2-line text-5xl text-white opacity-30"></i>
                    </div>
                    <div class="p-4">
                        <div class="flex gap-2 mb-2">
                            <span class="text-xs px-2 py-1 bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 rounded-full">#CSS</span>
                            <span class="text-xs px-2 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-full">#Grid</span>
                        </div>
                        <h3 class="font-bold mb-1 group-hover:text-blue-600">CSS Grid Mastery</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Build responsive layouts with CSS Grid</p>
                        <p class="text-xs text-gray-500">6 min read</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl sm:text-5xl font-bold mb-4">Ready to Share Your Story?</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Join thousands of writers and creators who are building communities and sharing knowledge on our platform.
            </p>
            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition font-bold text-lg">
                <i class="ri-pencil-line"></i>
                Start Writing Now
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h4 class="font-bold text-white mb-4">Blog Platform</h4>
                    <p class="text-sm">Share your stories and connect with millions of readers worldwide.</p>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Product</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('posts.index') }}" class="hover:text-white transition">Browse Articles</a></li>
                        <li><a href="{{ route('posts.index') }}" class="hover:text-white transition">Popular Topics</a></li>
                        <li><a href="{{ route('posts.index') }}" class="hover:text-white transition">Latest Posts</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Company</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-sm">
                <p>&copy; 2024 Blog Platform. All rights reserved. Built with <i class="ri-heart-fill text-red-500"></i></p>
            </div>
        </div>
    </footer>
</body>
</html>
<!-- End resources/views/welcome.blade.php -->
