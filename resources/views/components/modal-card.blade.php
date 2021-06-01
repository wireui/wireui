<x-modal {{ $attributes }}
    :spacing="$fullscreen ? '' : $spacing"
    :z-index="$zIndex"
    :max-width="$maxWidth"
    :blur="$blur">
    <x-card
        :title="$title"
        :rounded="$squared || $fullscreen ? '' : $rounded"
        :card-classes="$fullscreen ? 'min-h-screen' : ''"
        :shadow="$shadow"
        :padding="$padding"
        :divider="$divider">
        @if ($header)
            <x-slot name="header">
                {{ $header }}
            </x-slot>
        @else
            <x-slot name="action">
                <button class="focus:outline-none p-1 focus:ring-2 focus:ring-gray-200 rounded-full text-gray-300"
                    x-on:click="close">
                    <x-icon name="x" class="w-5 h-5" />
                </button>
            </x-slot>
        @endif

        {{ $slot }}

        @isset($footer)
            <x-slot name="footer">
                {{ $footer }}
            </x-slot>
        @endisset
    </x-card>
</x-modal>
