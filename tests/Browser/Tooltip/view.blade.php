<div>
    <h1>Tooltip test</h1>

    // test it_should_show_the_tooltip_using_magic_method_when_click_in_the_button_and_it_will_disappear_in_2_seconds
    <div x-data="{}">
        <x-button dusk="tooltip1" x-on:click="$tooltip('Tooltip 1')" green>
            Click Here 1
        </x-button>
    </div>

    // test it_should_show_the_tooltip_using_magic_method_when_click_in_the_button_and_it_will_disappear_in_500_milliseconds
    <div x-data="{}">
        <x-button dusk="tooltip2" x-on:click="$tooltip('Tooltip 2', 500)" green>
            Click Here 2
        </x-button>
    </div>

    // test it_should_show_the_tooltip_using_directive_method_when_hover_mouse_the_button
    <div x-data="{}">
        <x-button dusk="tooltip3" x-tooltip="Tooltip 3" green>
            Click Here 3
        </x-button>
    </div>

    // test it_should_show_the_tooltip_when_hover_mouse_the_button
    <x-tooltip>
        <x-slot name="tooltip">
            <strong>Tooltip 4</strong>
        </x-slot>

        <x-button dusk="tooltip4" green>
            Click Here 4
        </x-button>
    </x-tooltip>

    // test it_should_show_the_tooltip_when_click_in_the_button
    <x-tooltip trigger="click">
        <x-slot name="tooltip">
            <strong>Tooltip 5</strong>
        </x-slot>

        <x-button dusk="tooltip5" green>
            Click Here 5
        </x-button>
    </x-tooltip>

    // test it_should_show_the_tooltip_when_click_in_the_button_and_it_will_disappear_in_2_seconds
    <x-tooltip trigger="manual">
        <x-slot name="tooltip">
            <strong>Tooltip 6</strong>
        </x-slot>

        <x-button dusk="tooltip6" x-on:click="dispatch" green>
            Click Here 6
        </x-button>
    </x-tooltip>

    // test it_should_show_the_tooltip_when_click_in_the_button_and_it_will_disappear_in_500_milliseconds
    <x-tooltip trigger="manual" timeout="500">
        <x-slot name="tooltip">
            <strong>Tooltip 7</strong>
        </x-slot>

        <x-button dusk="tooltip7" x-on:click="dispatch" green>
            Click Here 7
        </x-button>
    </x-tooltip>
</div>
