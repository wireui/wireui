<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#buttons" label="Buttons">
            <x-docs::summary.item href="#solid-colors" label="Solid Colors" />
            <x-docs::summary.item href="#light-colors" label="Light Colors" />
            <x-docs::summary.item href="#outline-colors" label="Outline Colors" />
            <x-docs::summary.item href="#flat-colors" label="Flat Colors" />
            <x-docs::summary.item href="#mini-buttons" label="Mini Buttons" />
            <x-docs::summary.item href="#state-colors" label="State Colors" />
            <x-docs::summary.item href="#rounded-button" label="Rounded Button" />
            <x-docs::summary.item href="#circle-buttons" label="Circle Buttons" />
            <x-docs::summary.item href="#squared-button" label="Squared Button" />
            <x-docs::summary.item href="#button-icons" label="Button With Icons" />
            <x-docs::summary.item href="#button-sizes" label="Button Sizes" />
            <x-docs::summary.item href="#button-link" label="Button Link" />
            <x-docs::summary.item href="#loading-spinner" label="Loading Spinner" />
        </x-docs::summary.header>

        <x-docs::summary.header href="#button-options" label="Button Options" />

        <x-docs::summary.header href="#playground" label="Playground" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="buttons" title="Buttons" />

    <x-docs::text>
        The button component has multiple variants, colors, and options to customize. A straightforward API to use to
        enhance your application with beautiful components
    </x-docs::text>

    <x-docs::subtitle id="solid-colors" title="Solid Colors" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap items-center justify-center gap-4 mb-4">
                <x-button label="Default" />
                <x-button black label="Black" />
                <div
                    class="flex justify-center p-3 px-5 bg-black border rounded-md dark:border-none dark:p-0 dark:bg-transparent">
                    <x-button white label="White" />
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 xl:grid-cols-6">
                <x-button primary label="Primary" />
                <x-button secondary label="Secondary" />
                <x-button positive label="Positive" />
                <x-button negative label="Negative" />
                <x-button warning label="Warning" />
                <x-button info label="Info" />
                <x-button slate label="Slate" />
                <x-button gray label="Gray" />
                <x-button zinc label="Zinc" />
                <x-button neutral label="Neutral" />
                <x-button stone label="Stone" />
                <x-button red label="Red" />
                <x-button yellow label="Yellow" />
                <x-button amber label="Amber" />
                <x-button orange label="Orange" />
                <x-button lime label="Lime" />
                <x-button green label="Green" />
                <x-button emerald label="Emerald" />
                <x-button teal label="Teal" />
                <x-button cyan label="Cyan" />
                <x-button sky label="Sky" />
                <x-button blue label="Blue" />
                <x-button indigo label="Indigo" />
                <x-button violet label="Violet" />
                <x-button purple label="Purple" />
                <x-button fuchsia label="Fuchsia" />
                <x-button pink label="Pink" />
                <x-button rose label="Rose" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="light-colors" title="Light Colors" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap items-center justify-center mb-4">
                <x-button light label="Default" />
            </div>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 xl:grid-cols-6">
                <x-button light primary label="Primary" />
                <x-button light secondary label="Secondary" />
                <x-button light positive label="Positive" />
                <x-button light negative label="Negative" />
                <x-button light warning label="Warning" />
                <x-button light info label="Info" />
                <x-button light slate label="Slate" />
                <x-button light gray label="Gray" />
                <x-button light zinc label="Zinc" />
                <x-button light neutral label="Neutral" />
                <x-button light stone label="Stone" />
                <x-button light red label="Red" />
                <x-button light yellow label="Yellow" />
                <x-button light amber label="Amber" />
                <x-button light orange label="Orange" />
                <x-button light lime label="Lime" />
                <x-button light green label="Green" />
                <x-button light emerald label="Emerald" />
                <x-button light teal label="Teal" />
                <x-button light cyan label="Cyan" />
                <x-button light sky label="Sky" />
                <x-button light blue label="Blue" />
                <x-button light indigo label="Indigo" />
                <x-button light violet label="Violet" />
                <x-button light purple label="Purple" />
                <x-button light fuchsia label="Fuchsia" />
                <x-button light pink label="Pink" />
                <x-button light rose label="Rose" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="outline-colors" title="Outline Colors" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap items-center justify-center gap-4 mb-4">
                <x-button outline label="Default" />
                <x-button outline black label="Black" />
                <div
                    class="flex justify-center p-3 px-5 bg-black border rounded-md dark:border-none dark:p-0 dark:bg-transparent">
                    <x-button outline white label="White" />
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 xl:grid-cols-6 bg-red-500pr-4">
                <x-button outline primary label="Primary" />
                <x-button outline secondary label="Secondary" />
                <x-button outline positive label="Positive" />
                <x-button outline negative label="Negative" />
                <x-button outline warning label="Warning" />
                <x-button outline info label="Info" />
                <x-button outline slate label="Slate" />
                <x-button outline gray label="Gray" />
                <x-button outline zinc label="Zinc" />
                <x-button outline neutral label="Neutral" />
                <x-button outline stone label="Stone" />
                <x-button outline red label="Red" />
                <x-button outline yellow label="Yellow" />
                <x-button outline amber label="Amber" />
                <x-button outline orange label="Orange" />
                <x-button outline lime label="Lime" />
                <x-button outline green label="Green" />
                <x-button outline emerald label="Emerald" />
                <x-button outline teal label="Teal" />
                <x-button outline cyan label="Cyan" />
                <x-button outline sky label="Sky" />
                <x-button outline blue label="Blue" />
                <x-button outline indigo label="Indigo" />
                <x-button outline violet label="Violet" />
                <x-button outline purple label="Purple" />
                <x-button outline fuchsia label="Fuchsia" />
                <x-button outline pink label="Pink" />
                <x-button outline rose label="Rose" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="flat-colors" title="Flat Colors" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap items-center justify-center gap-4 mb-4">
                <x-button flat label="Default" />
                <x-button flat black label="Black" />
                <div
                    class="flex justify-center p-3 px-5 bg-black border rounded-md dark:border-none dark:p-0 dark:bg-transparent">
                    <x-button flat white label="White" />
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 xl:grid-cols-6">
                <x-button flat primary label="Primary" />
                <x-button flat secondary label="Secondary" />
                <x-button flat positive label="Positive" />
                <x-button flat negative label="Negative" />
                <x-button flat warning label="Warning" />
                <x-button flat info label="Info" />
                <x-button flat slate label="Slate" />
                <x-button flat gray label="Gray" />
                <x-button flat zinc label="Zinc" />
                <x-button flat neutral label="Neutral" />
                <x-button flat stone label="Stone" />
                <x-button flat red label="Red" />
                <x-button flat yellow label="Yellow" />
                <x-button flat amber label="Amber" />
                <x-button flat orange label="Orange" />
                <x-button flat lime label="Lime" />
                <x-button flat green label="Green" />
                <x-button flat emerald label="Emerald" />
                <x-button flat teal label="Teal" />
                <x-button flat cyan label="Cyan" />
                <x-button flat sky label="Sky" />
                <x-button flat blue label="Blue" />
                <x-button flat indigo label="Indigo" />
                <x-button flat violet label="Violet" />
                <x-button flat purple label="Purple" />
                <x-button flat fuchsia label="Fuchsia" />
                <x-button flat pink label="Pink" />
                <x-button flat rose label="Rose" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="mini-buttons" title="Mini Buttons" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap gap-3">
                <x-button-mini icon="home" />
                <x-button-mini primary icon="pencil" />
                <x-button-mini secondary icon="clipboard" />
                <x-button-mini positive icon="check" />
                <x-button-mini negative icon="x-mark" />
                <x-button-mini warning icon="exclamation-triangle" />
                <x-button-mini info icon="information-circle" />
                <x-button-mini secondary label="A" />
                <x-button-mini positive label="B" />
                <x-button-mini negative label="C" />
                <x-button-mini primary label="+" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="state-colors" title="State Colors" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex gap-4">
                <x-button label="Delete" right-icon="trash" interaction="negative" />
                <x-button label="Save" right-icon="check" flat interaction:solid="positive" />
                <x-button label="Cancel" right-icon="trash" outline hover="warning" focus:solid.gray />

                <x-button-mini rounded icon="trash" flat gray interaction="negative" />
                <x-button-mini rounded icon="plus" flat primary interaction:solid />
                <x-button-mini rounded icon="bookmark" flat gray hover:outline.negative focus:solid.positive />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::text>
        Sometimes you want to change the button style when the user is interacting with it.
        <br>
        For example, when the user is hovering over the button, you want to change the button color to
        another color.
        <br>
        To do this, you can use the
        <x-docs::mark>hover</x-docs::mark>,
        <x-docs::mark>focus</x-docs::mark>, and
        <x-docs::mark>interaction</x-docs::mark> attributes.
    </x-docs::text>

    <x-docs::text.title title="Effects:" />

    <x-docs::list>
        <x-docs::list.item>
            <b>
                <x-docs::mark>hover</x-docs::mark>:
            </b>
            when the mouse is over the button
        </x-docs::list.item>

        <x-docs::list.item>
            <b>
                <x-docs::mark>focus</x-docs::mark>:
            </b>
            when the button is focused or clicked
        </x-docs::list.item>

        <x-docs::list.item>
            <b>
                <x-docs::mark>interaction</x-docs::mark>:
            </b>
            hover and focus effects
        </x-docs::list.item>
    </x-docs::list>

    <x-docs::text.title title="Syntax:" />

    <x-docs::code.block no-copy language="blade"" :line-numbers="false" />

    <x-docs::subtitle id="rounded-button" title="Rounded Button" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 xl:grid-cols-6">
                <x-button rounded label="Default" />
                <x-button rounded primary label="Primary" />
                <x-button rounded secondary label="Secondary" />
                <x-button rounded positive label="Positive" />
                <x-button rounded negative label="Negative" />
                <x-button rounded warning label="Warning" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="circle-buttons" title="Circle Buttons" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap gap-3">
                <x-button-mini rounded icon="home" />
                <x-button-mini rounded primary icon="pencil" />
                <x-button-mini rounded secondary icon="clipboard" />
                <x-button-mini rounded positive icon="check" />
                <x-button-mini rounded negative icon="x-mark" />
                <x-button-mini rounded warning icon="exclamation-triangle" />
                <x-button-mini rounded info icon="information-circle" />
                <x-button-mini rounded secondary label="A" />
                <x-button-mini rounded positive label="B" />
                <x-button-mini rounded negative label="C" />
                <x-button-mini rounded primary label="+" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="squared-button" title="Squared Button" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 xl:grid-cols-6">
                <x-button squared label="Default" />
                <x-button squared primary label="Primary" />
                <x-button squared secondary label="Secondary" />
                <x-button squared positive label="Positive" />
                <x-button squared negative label="Negative" />
                <x-button squared warning label="Warning" />
            </div>
            <div class="flex items-center gap-4 mt-5">
                <x-button-mini squared icon="home" />
                <x-button-mini squared primary icon="pencil" />
                <x-button-mini squared positive icon="check" />
                <x-button-mini squared negative icon="x-mark" />
                <x-button-mini squared secondary label="A" />
                <x-button-mini squared primary label="+" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="button-icons" title="Button With Icons" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 xl:grid-cols-6">
                <x-button icon="home" label="Default" />
                <x-button icon="pencil" primary label="Primary" />
                <x-button icon="clipboard" secondary label="Secondary" />
                <x-button icon="arrow-left" right-icon="arrow-right" positive label="Positive" />
                <x-button right-icon="x-mark" negative label="Negative" />
                <x-button right-icon="exclamation-triangle" warning label="Warning" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="button-sizes" title="Button Sizes" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="space-x-2 space-y-2">
                <x-button 2xs secondary label="2xs button" />
                <x-button xs primary label="xs button" />
                <x-button sm positive label="sm button" />
                <x-button md negative label="md button" />
                <x-button lg warning label="lg button" />
                <x-button xl stone label="xl button" />
                <x-button 2xl black label="2xl button" />
            </div>
            <div class="space-x-2 space-y-2">
                <x-button 2xs secondary label="2xs" icon="pencil" />
                <x-button xs primary label="xs" icon="clipboard" />
                <x-button sm positive label="sm" icon="check" />
                <x-button md negative label="md" icon="trash" />
                <x-button lg warning label="lg button" icon="exclamation-triangle" />
                <x-button xl stone label="xl button" icon="information-circle" />
                <x-button 2xl black label="2xl button" icon="no-symbol" />
            </div>
            <div class="space-x-2 space-y-2">
                <x-button-mini rounded 2xs primary label="A" />
                <x-button-mini rounded xs secondary label="A" />
                <x-button-mini rounded sm positive label="A" />
                <x-button-mini rounded md negative label="A" />
                <x-button-mini rounded lg warning label="A" />
                <x-button-mini rounded xl info label="A" />
                <x-button-mini rounded 2xl black label="A" />
            </div>
            <div class="space-x-2 space-y-2">
                <x-button-mini rounded 2xs primary icon="pencil" />
                <x-button-mini rounded xs secondary icon="clipboard" />
                <x-button-mini rounded sm positive icon="check" />
                <x-button-mini rounded md negative icon="trash" />
                <x-button-mini rounded lg warning icon="exclamation-triangle" />
                <x-button-mini rounded xl info icon="information-circle" />
                <x-button-mini rounded 2xl black icon="no-symbol" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="button-link" title="Button Link" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex items-center gap-4">
                <x-button href="https://google.com?ref={{ config('app.url') }}" target="_blank" label="Go to Google"
                    teal />

                <x-button-mini href="https://github.com/PH7-Jack?ref={{ config('app.url') }}" target="_blank" rounded
                    black>
                    <x-icons.github class="w-4 h-4 fill-white" />
                </x-button-mini>
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-alert class="mb-4" info>
        <x-slot name="title">
            You can show a spinner loading when an action if fired. You can pass <b>wire:target</b> value into
            <b>spinner</b> prop If no value is give, all loading effects will be applied.
        </x-slot>
    </x-alert>

    <x-docs::subtitle id="loading-spinner" title="Loading Spinner" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap items-center gap-4">
                <x-button-mini rounded wire:click="$refresh" teal icon="check" spinner />

                <x-button-mini rounded wire:click="sleeping" teal icon="check" spinner.longest />

                <x-button wire:click="$refresh" spinner primary label="Without target" />

                <x-button wire:click="sleeping" spinner="sleeping" primary label="With target" />

                <x-button wire:click="sleeping" spinner.longest="sleeping" loading-delay="short" primary
                    label="With target + delay modifier" />

                <x-button wire:click="sleeping" spinner.longest="sleeping" loading-delay="short" primary
                    label="With target + delay modifier" right-icon="x-mark" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-alert class="mb-4" warning>
        <x-slot name="title">
            The attributes [squared, rounded, right-icon] are not supported in <b>button.circle</b> component.
        </x-slot>
    </x-alert>

    {{-- Section --}}
    <x-docs::title id="button-options" title="Button Options" />

    <x-docs::table>
        <x-docs::table.row prop="2xs" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="xs" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="sm" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="md" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="lg" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="xl" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="size" required="false" default="sm" type="string" available="2xs|xs|sm|default|md|lg|xl" />

        <x-docs::table.row prop="color" required="false" default="null" type="string" available="default colors + all tailwind colors" />

        <x-docs::table.row prop="rounded" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="squared" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="flat" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="full" required="false" default="false" type="boolean" available="boolean" />

        <x-docs::table.row prop="label" required="false" default="null" type="string" available="*" />
        <x-docs::table.row prop="icon" required="false" default="null" type="string" available="all heroicons" />
        <x-docs::table.row prop="right-icon" required="false" default="null" type="string" available="all heroicons" />
        <x-docs::table.row prop="spinner" required="false" default="null" type="boolean|string" available="*" />
        <x-docs::table.row prop="href" required="false" default="null" type="string" available="all links" />
    </x-docs::table>

    {{-- Playground --}}
    @livewire('playground.buttons')
</x-docs-scope>
