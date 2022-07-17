<span class="{{ $badgeClasses }}">
    {{ $name ?? $slot }}
    @if($close)
        <button type="button" class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center hover:bg-gray-200 hover:text-gray-500 focus:outline-none focus:bg-gray-500 focus:text-white">
            <x-icon wire:click="close" name="x" class="h-3/4 w-3/4" />
        </button>
    @endif
</span>
