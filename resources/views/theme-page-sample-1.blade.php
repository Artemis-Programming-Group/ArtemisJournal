<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Platform - Posts</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Swiper.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <!-- Highlight.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

    <!-- Remixicon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">

    <style>
        [x-cloak] { display: none; }
        code {
            font-family: 'Monaco', 'Courier New', monospace;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <!-- Toggle for page switching -->
    <div x-data="{ currentPage: 'list' }" x-cloak class="min-h-screen">

        <!-- Posts List Page -->
        <div x-show="currentPage === 'list'" class="transition-opacity duration-300">
            <!-- Navigation -->
            <nav class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 z-40">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-blue-600">Blog</h1>
                    <button @click="currentPage = 'details'" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        View Post Details
                    </button>
                </div>
            </nav>

            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12 sm:py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-3xl sm:text-4xl font-bold mb-4">Explore Stories & Articles</h2>
                    <p class="text-lg text-blue-100 mb-6">Discover insights on web development, coding tips, and best practices</p>

                    <!-- Search Bar -->
                    <div class="relative max-w-md">
                        <input type="text" placeholder="Search posts..." class="w-full px-4 py-3 rounded-lg text-gray-900 bg-white focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <i class="ri-search-line absolute right-3 top-3.5 text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-16 z-30">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex flex-wrap gap-2">
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-medium hover:bg-blue-700 transition">All</button>
                        <button class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-full text-sm font-medium hover:bg-gray-300 dark:hover:bg-gray-600 transition">JavaScript</button>
                        <button class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-full text-sm font-medium hover:bg-gray-300 dark:hover:bg-gray-600 transition">React</button>
                        <button class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-full text-sm font-medium hover:bg-gray-300 dark:hover:bg-gray-600 transition">Laravel</button>
                        <button class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-full text-sm font-medium hover:bg-gray-300 dark:hover:bg-gray-600 transition">Web Design</button>
                    </div>
                </div>
            </div>

            <!-- Posts Grid -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Post Card 1 -->
                    <article class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 group cursor-pointer" @click="currentPage = 'details'">
                        <div class="aspect-video bg-gradient-to-br from-purple-400 to-pink-400 overflow-hidden">
                            <div class="w-full h-full flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                <i class="ri-code-line text-white text-6xl opacity-30"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="inline-block bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 px-3 py-1 rounded-full text-xs font-medium">#JavaScript</span>
                                <span class="inline-block bg-pink-100 dark:bg-pink-900 text-pink-800 dark:text-pink-200 px-3 py-1 rounded-full text-xs font-medium">#Advanced</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">Mastering Async/Await in JavaScript</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Learn how to write efficient asynchronous code using modern JavaScript patterns. Deep dive into promises, async functions, and error handling.</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full"></div>
                                    <div>
                                        <p class="text-sm font-medium">Sarah Chen</p>
                                        <p class="text-xs text-gray-500">5 min read</p>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">Mar 15, 2024</span>
                            </div>
                        </div>
                    </article>

                    <!-- Post Card 2 -->
                    <article class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 group cursor-pointer" @click="currentPage = 'details'">
                        <div class="aspect-video bg-gradient-to-br from-green-400 to-blue-400 overflow-hidden">
                            <div class="w-full h-full flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                <i class="ri-reactjs-line text-white text-6xl opacity-30"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="inline-block bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-3 py-1 rounded-full text-xs font-medium">#React</span>
                                <span class="inline-block bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-xs font-medium">#Hooks</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">Building Custom React Hooks</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Discover the power of custom hooks and how to create reusable logic for your React components. Best practices included.</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-blue-400 rounded-full"></div>
                                    <div>
                                        <p class="text-sm font-medium">Alex Kumar</p>
                                        <p class="text-xs text-gray-500">8 min read</p>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">Mar 12, 2024</span>
                            </div>
                        </div>
                    </article>

                    <!-- Post Card 3 -->
                    <article class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 group cursor-pointer" @click="currentPage = 'details'">
                        <div class="aspect-video bg-gradient-to-br from-red-400 to-orange-400 overflow-hidden">
                            <div class="w-full h-full flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                <i class="ri-layout-grid-2-line text-white text-6xl opacity-30"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="inline-block bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 px-3 py-1 rounded-full text-xs font-medium">#CSS</span>
                                <span class="inline-block bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200 px-3 py-1 rounded-full text-xs font-medium">#Grid</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">CSS Grid Layout Mastery</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Learn to build responsive layouts using CSS Grid. We'll cover grid lines, areas, and auto-placement algorithms.</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-gradient-to-br from-red-400 to-orange-400 rounded-full"></div>
                                    <div>
                                        <p class="text-sm font-medium">Maria Garcia</p>
                                        <p class="text-xs text-gray-500">6 min read</p>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">Mar 10, 2024</span>
                            </div>
                        </div>
                    </article>

                    <!-- Post Card 4 -->
                    <article class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 group cursor-pointer" @click="currentPage = 'details'">
                        <div class="aspect-video bg-gradient-to-br from-yellow-400 to-red-400 overflow-hidden">
                            <div class="w-full h-full flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                <i class="ri-terminal-line text-white text-6xl opacity-30"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="inline-block bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 px-3 py-1 rounded-full text-xs font-medium">#Backend</span>
                                <span class="inline-block bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 px-3 py-1 rounded-full text-xs font-medium">#Laravel</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">Laravel Best Practices</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Essential patterns and practices for building scalable Laravel applications. From architecture to deployment strategies.</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-gradient-to-br from-yellow-400 to-red-400 rounded-full"></div>
                                    <div>
                                        <p class="text-sm font-medium">James Wilson</p>
                                        <p class="text-xs text-gray-500">10 min read</p>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">Mar 8, 2024</span>
                            </div>
                        </div>
                    </article>

                    <!-- Post Card 5 -->
                    <article class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 group cursor-pointer" @click="currentPage = 'details'">
                        <div class="aspect-video bg-gradient-to-br from-indigo-400 to-purple-400 overflow-hidden">
                            <div class="w-full h-full flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                <i class="ri-database-2-line text-white text-6xl opacity-30"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="inline-block bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 px-3 py-1 rounded-full text-xs font-medium">#Database</span>
                                <span class="inline-block bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 px-3 py-1 rounded-full text-xs font-medium">#SQL</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">Optimizing Database Queries</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Learn indexing strategies, query optimization, and how to identify performance bottlenecks in your database.</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-400 to-purple-400 rounded-full"></div>
                                    <div>
                                        <p class="text-sm font-medium">Emma Davis</p>
                                        <p class="text-xs text-gray-500">7 min read</p>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">Mar 5, 2024</span>
                            </div>
                        </div>
                    </article>

                    <!-- Post Card 6 -->
                    <article class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 group cursor-pointer" @click="currentPage = 'details'">
                        <div class="aspect-video bg-gradient-to-br from-cyan-400 to-blue-400 overflow-hidden">
                            <div class="w-full h-full flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                <i class="ri-shield-line text-white text-6xl opacity-30"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="inline-block bg-cyan-100 dark:bg-cyan-900 text-cyan-800 dark:text-cyan-200 px-3 py-1 rounded-full text-xs font-medium">#Security</span>
                                <span class="inline-block bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-xs font-medium">#WebDev</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">Web Security Essentials</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Comprehensive guide to securing your web applications. CSRF, XSS, authentication, and more covered.</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-gradient-to-br from-cyan-400 to-blue-400 rounded-full"></div>
                                    <div>
                                        <p class="text-sm font-medium">David Brown</p>
                                        <p class="text-xs text-gray-500">9 min read</p>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">Mar 1, 2024</span>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Load More Button -->
                <div class="mt-12 text-center">
                    <button class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                        Load More Posts
                    </button>
                </div>
            </div>
        </div>

        <!-- Post Details Page -->
        <div x-show="currentPage === 'details'" class="transition-opacity duration-300">
            <!-- Navigation -->
            <nav class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 z-40">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                    <button @click="currentPage = 'list'" class="flex items-center gap-2 text-blue-600 hover:text-blue-700">
                        <i class="ri-arrow-left-line"></i>
                        Back to Posts
                    </button>
                    <div class="flex items-center gap-3">
                        <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                            <i class="ri-heart-line text-gray-600 dark:text-gray-400"></i>
                        </button>
                        <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                            <i class="ri-bookmark-line text-gray-600 dark:text-gray-400"></i>
                        </button>
                        <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                            <i class="ri-share-forward-line text-gray-600 dark:text-gray-400"></i>
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Article Container -->
            <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

                <!-- Header -->
                <header class="mb-8">
                    <div class="mb-4 flex flex-wrap gap-2">
                        <span class="inline-block bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-sm font-medium">#JavaScript</span>
                        <span class="inline-block bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 px-3 py-1 rounded-full text-sm font-medium">#Advanced</span>
                        <span class="inline-block bg-pink-100 dark:bg-pink-900 text-pink-800 dark:text-pink-200 px-3 py-1 rounded-full text-sm font-medium">#Tutorial</span>
                    </div>
                    <h1 class="text-4xl sm:text-5xl font-bold mb-4 leading-tight">Mastering Async/Await in JavaScript</h1>
                    <p class="text-xl text-gray-600 dark:text-gray-400 mb-6">A comprehensive guide to writing efficient asynchronous code using modern JavaScript patterns</p>

                    <div class="flex items-center justify-between py-6 border-y border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full"></div>
                            <div>
                                <p class="font-semibold">Sarah Chen</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Full Stack Developer</p>
                            </div>
                        </div>
                        <div class="text-right text-sm text-gray-600 dark:text-gray-400">
                            <p>March 15, 2024</p>
                            <p>12 min read</p>
                        </div>
                    </div>
                </header>

                <!-- Featured Image -->
                <div class="my-12 aspect-video bg-gradient-to-br from-purple-400 to-pink-400 rounded-xl overflow-hidden flex items-center justify-center">
                    <i class="ri-image-line text-white text-7xl opacity-30"></i>
                </div>

                <!-- Main Content -->
                <section class="prose dark:prose-invert max-w-none mb-12">
                    <h2 class="text-3xl font-bold mt-8 mb-4">Introduction</h2>
                    <p class="text-lg text-gray-700 dark:text-gray-300 mb-6">Asynchronous programming is a fundamental concept in JavaScript that allows you to perform long-running tasks without blocking the main thread. Whether you're fetching data from an API, reading files, or making database queries, understanding async/await is crucial for writing efficient and responsive applications.</p>

                    <p class="text-lg text-gray-700 dark:text-gray-300 mb-6">In this comprehensive guide, we'll explore how async/await works, best practices for using it, and common patterns you'll encounter in real-world applications.</p>

                    <h2 class="text-3xl font-bold mt-8 mb-4">What is Async/Await?</h2>
                    <p class="text-lg text-gray-700 dark:text-gray-300 mb-6">Async/await is syntactic sugar built on top of Promises that makes asynchronous code look and behave more like synchronous code. It provides a cleaner and more intuitive way to work with asynchronous operations.</p>

                    <blockquote class="border-l-4 border-blue-600 pl-4 italic text-gray-600 dark:text-gray-400 my-6 text-lg">
                        "Async/await is one of the most important features in modern JavaScript. It transforms the way we write asynchronous code and makes it significantly more readable and maintainable."
                    </blockquote>

                    <h3 class="text-2xl font-bold mt-6 mb-3">Key Concepts</h3>
                    <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-300 mb-6">
                        <li><strong>Promise:</strong> An object representing the eventual completion of an async operation</li>
                        <li><strong>Async Function:</strong> A function declared with the async keyword that returns a Promise</li>
                        <li><strong>Await Expression:</strong> Pauses execution until the Promise is resolved</li>
                        <li><strong>Error Handling:</strong> Using try/catch blocks for error management</li>
                    </ul>
                </section>

                <!-- Code Block 1 -->
                <section class="my-12">
                    <h2 class="text-3xl font-bold mb-4">Basic Example</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">Here's a simple example of async/await in action:</p>
                    <div class="bg-gray-900 rounded-lg overflow-hidden">
                        <pre><code class="language-javascript">// Traditional Promise approach
function fetchUserData() {
  return fetch('/api/user')
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error(error));
}

// Modern async/await approach
async function fetchUserData() {
  try {
    const response = await fetch('/api/user');
    const data = await response.json();
    console.log(data);
  } catch (error) {
    console.error('Failed to fetch user:', error);
  }
}

// Calling the function
fetchUserData();</code></pre>
                    </div>
                </section>

                <!-- Code Block 2 -->
                <section class="my-12">
                    <h2 class="text-3xl font-bold mb-4">Advanced Pattern: Parallel Requests</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">When you need to fetch multiple resources efficiently, use Promise.all():</p>
                    <div class="bg-gray-900 rounded-lg overflow-hidden">
                        <pre><code class="language-javascript">// Sequential (slower) - waits for each request
async function fetchDataSequential() {
  const user = await fetch('/api/user').then(r => r.json());
  const posts = await fetch('/api/posts').then(r => r.json());
  const comments = await fetch('/api/comments').then(r => r.json());
  return { user, posts, comments };
}

// Parallel (faster) - fetches all at once
async function fetchDataParallel() {
  try {
    const [user, posts, comments] = await Promise.all([
      fetch('/api/user').then(r => r.json()),
      fetch('/api/posts').then(r => r.json()),
      fetch('/api/comments').then(r => r.json())
    ]);
    return { user, posts, comments };
  } catch (error) {
    console.error('One of the requests failed:', error);
  }
}

// Parallel with error handling for individual requests
async function fetchDataWithFallback() {
  const results = await Promise.allSettled([
    fetch('/api/user').then(r => r.json()),
    fetch('/api/posts').then(r => r.json()),
    fetch('/api/comments').then(r => r.json())
  ]);

  return results.map(result =>
    result.status === 'fulfilled' ? result.value : null
  );
}</code></pre>
                    </div>
                </section>

                <!-- File Structure Section -->
                <section class="my-12">
                    <h2 class="text-3xl font-bold mb-6">Project Structure</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">Here's the recommended file structure for organizing async utilities:</p>

                    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                        <div x-data="{
                            expanded: {
                                'src': true,
                                'utils': false,
                                'api': false,
                                'services': false
                            }
                        }">
                            <!-- Root items -->
                            <div class="p-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition" @click="expanded['src'] = !expanded['src']">
                                <div class="flex items-center gap-2">
                                    <i :class="expanded['src'] ? 'ri-folder-open-line' : 'ri-folder-line'"></i>
                                    <span class="font-medium">src/</span>
                                </div>
                            </div>

                            <!-- src subfolder -->
                            <div x-show="expanded['src']">
                                <div class="p-4 pl-8 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition" @click="expanded['utils'] = !expanded['utils']">
                                    <div class="flex items-center gap-2">
                                        <i :class="expanded['utils'] ? 'ri-folder-open-line' : 'ri-folder-line'"></i>
                                        <span class="font-medium">utils/</span>
                                    </div>
                                </div>

                                <!-- utils files -->
                                <div x-show="expanded['utils']" class="space-y-2 pl-12 py-2">
                                    <div class="p-2 flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 rounded transition">
                                        <i class="ri-file-code-line"></i>
                                        <span>asyncHelpers.js</span>
                                    </div>
                                    <div class="p-2 flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 rounded transition">
                                        <i class="ri-file-code-line"></i>
                                        <span>errorHandler.js</span>
                                    </div>
                                </div>

                                <div class="p-4 pl-8 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition" @click="expanded['api'] = !expanded['api']">
                                    <div class="flex items-center gap-2">
                                        <i :class="expanded['api'] ? 'ri-folder-open-line' : 'ri-folder-line'"></i>
                                        <span class="font-medium">api/</span>
                                    </div>
                                </div>

                                <!-- api files -->
                                <div x-show="expanded['api']" class="space-y-2 pl-12 py-2">
                                    <div class="p-2 flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 rounded transition">
                                        <i class="ri-file-code-line"></i>
                                        <span>client.js</span>
                                    </div>
                                    <div class="p-2 flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 rounded transition">
                                        <i class="ri-file-code-line"></i>
                                        <span>endpoints.js</span>
                                    </div>
                                </div>

                                <div class="p-4 pl-8 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition" @click="expanded['services'] = !expanded['services']">
                                    <div class="flex items-center gap-2">
                                        <i :class="expanded['services'] ? 'ri-folder-open-line' : 'ri-folder-line'"></i>
                                        <span class="font-medium">services/</span>
                                    </div>
                                </div>

                                <!-- services files -->
                                <div x-show="expanded['services']" class="space-y-2 pl-12 py-2 border-b border-gray-200 dark:border-gray-700">
                                    <div class="p-2 flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 rounded transition">
                                        <i class="ri-file-code-line"></i>
                                        <span>userService.js</span>
                                    </div>
                                    <div class="p-2 flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 rounded transition">
                                        <i class="ri-file-code-line"></i>
                                        <span>postService.js</span>
                                    </div>
                                </div>

                                <div class="p-4 pl-8 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                                        <i class="ri-file-code-line"></i>
                                        <span>index.js</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Root files -->
                            <div class="p-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                                    <i class="ri-file-code-line"></i>
                                    <span>package.json</span>
                                </div>
                            </div>
                            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                                    <i class="ri-file-code-line"></i>
                                    <span>.env.example</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Accordion Section: Course Topics -->
                <section class="my-12">
                    <h2 class="text-3xl font-bold mb-6">Learning Path</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-6">Master async/await through these structured lessons and concepts:</p>

                    <div x-data="{ openTopic: 1 }" class="space-y-3">
                        <!-- Topic 1 -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <button @click="openTopic = openTopic === 1 ? null : 1" class="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 flex items-center justify-center bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 rounded-full font-semibold">1</div>
                                    <span class="font-semibold">Promises Fundamentals</span>
                                </div>
                                <i :class="openTopic === 1 ? 'ri-chevron-up-line' : 'ri-chevron-down-line'" class="text-gray-600 dark:text-gray-400"></i>
                            </button>
                            <div x-show="openTopic === 1" class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                                <p class="text-gray-700 dark:text-gray-300 mb-4">Learn the fundamentals of JavaScript Promises, including:</p>
                                <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-400">
                                    <li>Creating and resolving promises</li>
                                    <li>Promise states: pending, fulfilled, rejected</li>
                                    <li>Chaining with .then() and .catch()</li>
                                    <li>Error handling with finally()</li>
                                </ul>
                                <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">⏱️ Duration: 15 minutes</p>
                            </div>
                        </div>

                        <!-- Topic 2 -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <button @click="openTopic = openTopic === 2 ? null : 2" class="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 flex items-center justify-center bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-400 rounded-full font-semibold">2</div>
                                    <span class="font-semibold">Async Functions Syntax</span>
                                </div>
                                <i :class="openTopic === 2 ? 'ri-chevron-up-line' : 'ri-chevron-down-line'" class="text-gray-600 dark:text-gray-400"></i>
                            </button>
                            <div x-show="openTopic === 2" class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                                <p class="text-gray-700 dark:text-gray-300 mb-4">Understand how to declare and use async functions:</p>
                                <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-400">
                                    <li>Async function declarations and expressions</li>
                                    <li>Arrow functions with async</li>
                                    <li>Return values from async functions</li>
                                    <li>Understanding implicit Promise wrapping</li>
                                </ul>
                                <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">⏱️ Duration: 12 minutes</p>
                            </div>
                        </div>

                        <!-- Topic 3 -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <button @click="openTopic = openTopic === 3 ? null : 3" class="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 flex items-center justify-center bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-400 rounded-full font-semibold">3</div>
                                    <span class="font-semibold">Error Handling Patterns</span>
                                </div>
                                <i :class="openTopic === 3 ? 'ri-chevron-up-line' : 'ri-chevron-down-line'" class="text-gray-600 dark:text-gray-400"></i>
                            </button>
                            <div x-show="openTopic === 3" class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                                <p class="text-gray-700 dark:text-gray-300 mb-4">Master error handling in async code:</p>
                                <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-400">
                                    <li>Try/catch blocks with async/await</li>
                                    <li>Global error handlers</li>
                                    <li>Promise rejection handling</li>
                                    <li>Custom error classes</li>
                                </ul>
                                <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">⏱️ Duration: 18 minutes</p>
                            </div>
                        </div>

                        <!-- Topic 4 -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <button @click="openTopic = openTopic === 4 ? null : 4" class="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 flex items-center justify-center bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-400 rounded-full font-semibold">4</div>
                                    <span class="font-semibold">Advanced Patterns</span>
                                </div>
                                <i :class="openTopic === 4 ? 'ri-chevron-up-line' : 'ri-chevron-down-line'" class="text-gray-600 dark:text-gray-400"></i>
                            </button>
                            <div x-show="openTopic === 4" class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                                <p class="text-gray-700 dark:text-gray-300 mb-4">Explore advanced techniques and patterns:</p>
                                <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-400">
                                    <li>Parallel execution with Promise.all()</li>
                                    <li>Race conditions with Promise.race()</li>
                                    <li>Promise.allSettled() for robustness</li>
                                    <li>Timeout patterns and cancellation</li>
                                </ul>
                                <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">⏱️ Duration: 20 minutes</p>
                            </div>
                        </div>

                        <!-- Topic 5 -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <button @click="openTopic = openTopic === 5 ? null : 5" class="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 flex items-center justify-center bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-400 rounded-full font-semibold">5</div>
                                    <span class="font-semibold">Real-World Examples</span>
                                </div>
                                <i :class="openTopic === 5 ? 'ri-chevron-up-line' : 'ri-chevron-down-line'" class="text-gray-600 dark:text-gray-400"></i>
                            </button>
                            <div x-show="openTopic === 5" class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                                <p class="text-gray-700 dark:text-gray-300 mb-4">Apply concepts to practical use cases:</p>
                                <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-400">
                                    <li>API data fetching and pagination</li>
                                    <li>File uploads and processing</li>
                                    <li>Database operations</li>
                                    <li>Complex data transformation pipelines</li>
                                </ul>
                                <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">⏱️ Duration: 25 minutes</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Slider Section: Related Posts -->
                <section class="my-12">
                    <h2 class="text-3xl font-bold mb-6">Related Articles</h2>

                    <div class="swiper relatedSwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                    <div class="aspect-video bg-gradient-to-br from-green-400 to-blue-400 flex items-center justify-center">
                                        <i class="ri-reactjs-line text-white text-5xl opacity-30"></i>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-semibold mb-2 line-clamp-2">React Hooks Deep Dive</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Learn to build custom hooks and manage state effectively</p>
                                        <div class="flex items-center justify-between text-xs text-gray-500">
                                            <span>Alex Kumar</span>
                                            <span>8 min</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                    <div class="aspect-video bg-gradient-to-br from-red-400 to-orange-400 flex items-center justify-center">
                                        <i class="ri-layout-grid-2-line text-white text-5xl opacity-30"></i>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-semibold mb-2 line-clamp-2">CSS Grid Layout Mastery</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Build responsive layouts with modern CSS Grid techniques</p>
                                        <div class="flex items-center justify-between text-xs text-gray-500">
                                            <span>Maria Garcia</span>
                                            <span>6 min</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                    <div class="aspect-video bg-gradient-to-br from-indigo-400 to-purple-400 flex items-center justify-center">
                                        <i class="ri-database-2-line text-white text-5xl opacity-30"></i>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-semibold mb-2 line-clamp-2">Database Query Optimization</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Discover indexing strategies and performance tuning</p>
                                        <div class="flex items-center justify-between text-xs text-gray-500">
                                            <span>Emma Davis</span>
                                            <span>7 min</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                    <div class="aspect-video bg-gradient-to-br from-cyan-400 to-blue-400 flex items-center justify-center">
                                        <i class="ri-shield-line text-white text-5xl opacity-30"></i>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-semibold mb-2 line-clamp-2">Web Security Essentials</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Protect your applications from common security vulnerabilities</p>
                                        <div class="flex items-center justify-between text-xs text-gray-500">
                                            <span>David Brown</span>
                                            <span>9 min</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Swiper navigation -->
                        <div class="swiper-button-prev bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-full w-10 h-10 flex items-center justify-center text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition"></div>
                        <div class="swiper-button-next bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-full w-10 h-10 flex items-center justify-center text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition"></div>
                    </div>
                </section>

                <!-- Engagement Section -->
                <section class="my-12 bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg p-8">
                    <h3 class="text-2xl font-bold mb-4">Found this helpful?</h3>
                    <p class="mb-6">Share your thoughts or ask questions in the comments section below. Your feedback helps us create better content!</p>
                    <div class="flex flex-wrap gap-3">
                        <button class="px-6 py-2 bg-white text-blue-600 rounded-lg font-medium hover:bg-gray-100 transition">
                            Share Article
                        </button>
                        <button class="px-6 py-2 border-2 border-white text-white rounded-lg font-medium hover:bg-blue-700 transition">
                            Subscribe for More
                        </button>
                    </div>
                </section>

                <!-- Comments Section -->
                <section class="my-12">
                    <h3 class="text-2xl font-bold mb-6">Comments</h3>
                    <div class="space-y-6">
                        <!-- Comment 1 -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-200 dark:border-gray-700">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-blue-400 rounded-full flex-shrink-0"></div>
                                <div class="flex-1">
                                    <p class="font-semibold">John Developer</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">2 hours ago</p>
                                </div>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300">Great explanation! This really clarified the difference between Promise.all() and Promise.allSettled(). I'll definitely use these patterns in my next project.</p>
                        </div>

                        <!-- Comment 2 -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-200 dark:border-gray-700">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full flex-shrink-0"></div>
                                <div class="flex-1">
                                    <p class="font-semibold">Lisa Frontend</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">1 hour ago</p>
                                </div>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300">Could you provide an example of handling timeouts with async/await? I'm struggling with that in my current project.</p>
                        </div>
                    </div>

                    <!-- Comment Form -->
                    <div class="mt-8 bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-200 dark:border-gray-700">
                        <h4 class="font-semibold mb-4">Leave a Comment</h4>
                        <form class="space-y-4">
                            <div>
                                <input type="text" placeholder="Your name" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600">
                            </div>
                            <div>
                                <input type="email" placeholder="Your email" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600">
                            </div>
                            <div>
                                <textarea placeholder="Your comment..." rows="4" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600"></textarea>
                            </div>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                                Post Comment
                            </button>
                        </form>
                    </div>
                </section>
            </article>
        </div>
    </div>

    <!-- Initialize Highlight.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            hljs.highlightAll();
        });
    </script>

    <!-- Initialize Swiper -->
    <script>
        const swiper = new Swiper('.relatedSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>
</body>
</html>
                