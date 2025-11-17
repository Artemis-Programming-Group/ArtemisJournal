@props([
'items' => [],
'wireNavigate' => true
])

<nav class="flex items-center gap-2 mb-6">
    @foreach($items as $key => $item)
    @if(is_array($item))
    <a href="{{ $item['url'] }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300" {{ $wireNavigate ? 'wire:navigate' : '' }}>
        {{ $item['label'] }}
    </a>
    @else
    <span class="text-gray-600 dark:text-gray-400">{{ $item }}</span>
    @endif

    @if(!$loop->last)
    <span class="text-gray-400">/</span>
    @endif
    @endforeach
</nav>
