<div x-data="{active:false,open:false}">
    <a
    href="{{ $href ? route($href) : 'javascript:void(0)' }}"
    @if (!$href)
    @click="open = !open"
    @click.away="open = false"
    @close.stop="open = false"
    @endif
    class="pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-indigo-600 dark:hover:text-white hover:bg-indigo-100 dark:hover:bg-gray-800 hover:border-indigo-400 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-400 transition flex items-center"
    :class="{'bg-indigo-200': active || open}"
    >
        <i class="mdi mdi-{{ $icon }} mr-4"></i>
        <span>{{ __($title) }}</span>
        @if (!$href)
        <span class="ml-auto">
            <svg class="w-4 h-4 transition-transform transform" :class="{ '-rotate-90': !open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </span>
        @endif
    </a>

    <div x-show="open" class="mt-2 space-y-2 px-4 mb-4">
        @foreach ($subs as $key)
        <a href="{{ route($key->link) }}" class="block px-4 text-sm text-gray-600 transition-colors duration-200 rounded-md hover:text-indigo-600">
            <i class="mdi mdi-{{ $key->icon }} mr-4 align-middle"></i>
            <span>{{ __($key->title) }}</span>
        </a>
        @endforeach
    </div>
    <!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
</div>