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
            @slot('header', null, $header->attributes->getAttributes())
                {{ $header }}
            @endslot
        @elseif(!$hideClose)
            @slot('action', null, $action->attributes->getAttributes())
                <button class="p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-secondary-200 text-secondary-300"
                        x-on:click="close"
                        tabindex="-1">
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        name="x-mark"
                        class="w-5 h-5"
                    />
                </button>
            @endslot
        @endif

        {{ $slot }}

        @if(isset($footer))
            @slot('footer', null, $footer->attributes->getAttributes())
                {{ $footer }}
            @endslot
        @endif
    </x-dynamic-component>
</x-dynamic-component>
