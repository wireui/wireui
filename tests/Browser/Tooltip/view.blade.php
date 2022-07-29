<div class="mt-12 space-x-4 space-y-4">
    <h1>Tooltip test</h1>

    // test it_should_show_the_tooltip_when_hover_mouse_the_button
    <x-tooltip>
        <x-slot name="tooltip">
            <strong>Tooltip 1</strong>
        </x-slot>

        <x-button dusk="tooltip1" green>
            Click Here 1
        </x-button>
    </x-tooltip>

    // test it_should_show_the_tooltip_when_click_in_the_button
    <x-tooltip trigger="click">
        <x-slot name="tooltip">
            <strong>Tooltip 2</strong>
        </x-slot>

        <x-button dusk="tooltip2" green>
            Click Here 2
        </x-button>
    </x-tooltip>

    // test it_should_show_the_tooltip_when_click_in_the_button_and_it_will_disappear_in_2_seconds
    <x-tooltip trigger="manual">
        <x-slot name="tooltip">
            <strong>Tooltip 3</strong>
        </x-slot>

        <x-button dusk="tooltip3" x-on:click="dispatch" green>
            Click Here 3
        </x-button>
    </x-tooltip>

    // test it_should_show_the_tooltip_when_click_in_the_button_and_it_will_disappear_in_500_miliseconds
    <x-tooltip trigger="manual" timeout="500">
        <x-slot name="tooltip">
            <strong>Tooltip 4</strong>
        </x-slot>

        <x-button dusk="tooltip4" x-on:click="dispatch" green>
            Click Here 4
        </x-button>
    </x-tooltip>
</div>
