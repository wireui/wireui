<x-dynamic-component
    :component="WireUi::component('modal')"
    {{ $attributes }}
    :spacing="$fullscreen ? '' : $spacing"
    :z-index="$zIndex"
    :max-width="$maxWidth"
    :align="$align"
    :blur="$blur"
>
    <x-dynamic-component
        :component="WireUi::component('card')"
        :title="$title"
        :rounded="$squared || $fullscreen ? '' : $rounded"
        :card-classes="$fullscreen ? 'min-h-screen' : ''"
        :color="$color"
        :shadow="$shadow"
        :padding="$padding"
    >
        @if (isset($header))
            <x-slot name="header">
                {{ $header }}
            </x-slot>
        @elseif(!$hideClose)
            <x-slot name="action">
                <button class="p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-secondary-200 text-secondary-300"
                        x-on:click="close"
                        tabindex="-1">
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        name="x-mark"
                        class="w-5 h-5"
                    />
                </button>
            </x-slot>
        @endif

        {{ $slot }}

        @if(isset($footer))
            <x-slot name="footer">
                {{ $footer }}
            </x-slot>
        @endif
    </x-dynamic-component>
</x-dynamic-component>
