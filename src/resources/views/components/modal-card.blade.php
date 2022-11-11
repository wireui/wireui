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
        :shadow="$shadow"
        :padding="$padding"
        :divider="$divider">
        @if ($header)
            <x-slot name="header">
                {{ $header }}
            </x-slot>
        @elseif(!$hideClose)
            <x-slot name="action">
                <button class="focus:outline-none p-1 focus:ring-2 focus:ring-secondary-200 rounded-full text-secondary-300"
                        x-on:click="close"
                        tabindex="-1">
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        name="x"
                        class="w-5 h-5"
                    />
                </button>
            </x-slot>
        @endif

        {{ $slot }}

        @isset($footer)
            <x-slot name="footer">
                {{ $footer }}
            </x-slot>
        @endisset
    </x-dynamic-component>
</x-dynamic-component>
