<div class="relative inline-block text-left"
    x-data="{
        open: false,

        close() { this.open = false }
    }"
    x-on:click.away="close"
    x-on:keydown.escape.window="close">
    <div class="cursor-pointer focus:outline-none" x-on:click="open = !open">
        @if (isset($trigger))
            {{ $trigger }}
        @else
            <x-icon name="dots-vertical" class="w-4 h-4 text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out" />
        @endif
    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="{{ $getAlign() }} absolute mt-2 w-56"
         style="display: none;"
         @unless($persistent) x-on:click="close" @endunless>
        <div class="relative max-h-60 overflow-y-auto overflow-x-hidden border border-gray-200 rounded-lg shadow-lg bg-white">
            {{ $slot }}
        </div>
    </div>
</div>
