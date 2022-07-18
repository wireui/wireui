<span class="{{ $badgeClasses }}">
    @if($pulse)
        <span class="flex absolute h-2 w-2">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 {{ $pulsePingColor }}"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 {{ $pulseColor }}"></span>
        </span>
    @endif
    <span @if($pulse) class="ml-4" @endif>{{ $name ?? $slot }}</span>
    @if($close)
        <button type="button" class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center hover:bg-gray-200 hover:text-gray-500 focus:outline-none focus:bg-gray-500 focus:text-white">
            <x-icon wire:click="close" name="x" class="h-3/4 w-3/4" />
        </button>
    @endif
</span>
