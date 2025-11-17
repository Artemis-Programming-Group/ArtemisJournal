@props([
    'actions' => [],
    'columns' => 'lg:grid-cols-4',
])

<div class="mb-12">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
        <i class="ri-flash-line text-blue-600"></i>
        {{ __('Quick Actions') }}
    </h3>

    <div class="grid grid-cols-2 sm:grid-cols-3 {{ $columns }} gap-4">
        @forelse($actions as $action)
            @if(isset($action['disabled']) && $action['disabled'])
                <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br {{ $action['gradient'] }} shadow-md opacity-50 cursor-default aspect-square flex flex-col items-center justify-center p-6 text-white">
                    <div class="absolute inset-0 bg-black/0 transition"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-16 h-16 mx-auto mb-3 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="ri-{{ $action['icon'] }} text-3xl"></i>
                        </div>
                        <h4 class="font-semibold text-sm">{{ $action['title'] }}</h4>
                        <p class="text-xs text-white/80 mt-1">{{ $action['label'] ?? 'Coming soon' }}</p>
                    </div>
                </div>
            @else
                <a wireNavigate href="{{ $action['url'] }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-br {{ $action['gradient'] }} hover:shadow-lg shadow-md transition duration-300 aspect-square flex flex-col items-center justify-center p-6 text-white">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-16 h-16 mx-auto mb-3 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition">
                            <i class="ri-{{ $action['icon'] }} text-3xl"></i>
                        </div>
                        <h4 class="font-semibold text-sm">{{ $action['title'] }}</h4>
                        <p class="text-xs text-white/80 mt-1">{{ $action['label'] ?? '' }}</p>
                    </div>
                </a>
            @endif
        @empty
            <p class="text-gray-600 dark:text-gray-400">No actions available</p>
        @endforelse
    </div>
</div>
