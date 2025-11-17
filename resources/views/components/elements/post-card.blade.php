@props([
'title' => null,
'excerpt' => null,
'tags' => [],
'author' => null,
'readingTime' => null,
'createdAt' => null,
'bgColors' => ['from-purple-400 to-pink-400', 'from-green-400 to-blue-400', 'from-red-400 to-orange-400', 'from-yellow-400 to-red-400', 'from-indigo-400 to-purple-400', 'from-cyan-400 to-blue-400'],
])


<article class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 group cursor-pointer" @click="currentPage = 'details'">
    <div class="aspect-video bg-linear-to-br {{ $bgColors[rand(0,5)] }} overflow-hidden">
        <div class="w-full h-full flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
            <i class="ri-stairs-fill text-white text-6xl opacity-30"></i>

        </div>
    </div>
    <div class="p-6">
        <div class="flex flex-wrap gap-2 mb-3">
            @foreach ($tags ?? [] as $tag )
            <span class="inline-block bg-pink-100 dark:bg-pink-900 text-pink-800 dark:text-pink-200 px-3 py-1 rounded-full text-xs font-medium"></span>
            @endforeach
        </div>
        <h3 class="text-xl font-bold mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
            {{ $title ?? '' }}
        </h3>
        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
            {{ $excerpt ?? '' }}
        </p>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-linear-to-br from-purple-400 to-pink-400 rounded-full"></div>
                <div>
                    <p class="text-sm font-medium">{{ $author ?? '' }}</p>
                    <p class="text-xs text-gray-500">{{ $readingTime ?? '' }}</p>
                </div>
            </div>
            <span class="text-xs text-gray-500">{{ $createdAt ?? '' }}</span>
        </div>
    </div>
</article>
