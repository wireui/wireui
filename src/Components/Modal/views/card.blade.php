@php($except = [
    'title',
    'shadow',
    'rounded',
    'squared',
    'padding',
    'borderless',
    'shadowless',
])

<x-dynamic-component
    :component="WireUi::component('modal')"
    :spacing="$fullscreen ? 'p-0' : $spacing"
    :persistent="$persistent"
    :attributes="$attributes->except($except)"
>
    <x-dynamic-component
        :component="WireUi::component('card')"
        :attributes="$attributes->only($except)"
        @class(['w-full', 'min-h-screen' => $fullscreen])
    >
        @if (!$persistent && !$hideClose)
            @slot('action')
                <button class="p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-secondary-200 text-secondary-300"
                    x-on:click="close"
                    tabindex="-1"
                >
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        name="x-mark"
                        class="w-5 h-5"
                    />
                </button>
            @endslot
        @endif

        {{ $slot }}

        @foreach($__laravel_slots as $key => $value)
            @slot($key, $value)
        @endforeach
    </x-dynamic-component>
</x-dynamic-component>
