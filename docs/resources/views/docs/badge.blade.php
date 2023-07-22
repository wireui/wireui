<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#badges" label="Badges">
            <x-docs::summary.item href="#default-colors" label="Default Colors" />
            <x-docs::summary.item href="#outline-colors" label="Outline Colors" />
            <x-docs::summary.item href="#flat-colors" label="Flat Colors" />
            <x-docs::summary.item href="#rounded-badge" label="Rounded Badges" />
            <x-docs::summary.item href="#squared-badge" label="Squared Badges" />
            <x-docs::summary.item href="#circle-badges" label="Circle Badges" />
            <x-docs::summary.item href="#badge-with-icons" label="Badge With Icons" />
            <x-docs::summary.item href="#badge-sizes" label="Badge Sizes" />
            <x-docs::summary.item href="#badge-prepend-and-append" label="Badge Prepend and Append" />
        </x-docs::summary.header>

        <x-docs::summary.header href="#badge-options" label="Badge Options" />

        <x-docs::summary.header href="#playground" label="Playground" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="badges" title="Badges" />

    <x-docs::text>
        The badge component has multiples styles and options to customize.
        A simple API to use badge component with icons and any colors
    </x-docs::text>

    <x-docs::subtitle id="default-colors" title="Default Colors" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap items-center gap-3">
                <x-badge label="Default" />
                <x-badge primary label="Primary" />
                <x-badge secondary label="Secondary" />
                <x-badge positive label="Positive" />
                <x-badge negative label="Negative" />
                <x-badge warning label="Warning" />
                <x-badge info label="Info" />
                <x-badge dark label="Dark" />
                <div
                    class="flex justify-center p-2 bg-black border rounded-md dark:border-none dark:p-0 dark:bg-transparent">
                    <x-badge white label="White" />
                </div>
                <x-badge black label="Black" />
                <x-badge slate label="Slate" />
                <x-badge gray label="Gray" />
                <x-badge zinc label="Zinc" />
                <x-badge neutral label="Neutral" />
                <x-badge stone label="Stone" />
                <x-badge red label="Red" />
                <x-badge orange label="Orange" />
                <x-badge amber label="Amber" />
                <x-badge lime label="Lime" />
                <x-badge green label="Green" />
                <x-badge emerald label="Emerald" />
                <x-badge teal label="Teal" />
                <x-badge cyan label="Cyan" />
                <x-badge sky label="Sky" />
                <x-badge blue label="Blue" />
                <x-badge indigo label="Indigo" />
                <x-badge violet label="Violet" />
                <x-badge purple label="Purple" />
                <x-badge fuchsia label="Fuchsia" />
                <x-badge pink label="Pink" />
                <x-badge rose label="Rose" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="outline-colors" title="Outline Colors" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap items-center gap-3">
                <x-badge outline label="Default" />
                <x-badge outline primary label="Primary" />
                <x-badge outline secondary label="Secondary" />
                <x-badge outline positive label="Positive" />
                <x-badge outline negative label="Negative" />
                <x-badge outline warning label="Warning" />
                <x-badge outline info label="Info" />
                <x-badge outline dark label="Dark" />
                <div
                    class="flex justify-center p-2 bg-black border rounded-md dark:border-none dark:p-0 dark:bg-transparent">
                    <x-badge outline white label="White" />
                </div>
                <x-badge outline black label="Black" />
                <x-badge outline slate label="Slate" />
                <x-badge outline gray label="Gray" />
                <x-badge outline zinc label="Zinc" />
                <x-badge outline neutral label="Neutral" />
                <x-badge outline stone label="Stone" />
                <x-badge outline red label="Red" />
                <x-badge outline orange label="Orange" />
                <x-badge outline amber label="Amber" />
                <x-badge outline lime label="Lime" />
                <x-badge outline green label="Green" />
                <x-badge outline emerald label="Emerald" />
                <x-badge outline teal label="Teal" />
                <x-badge outline cyan label="Cyan" />
                <x-badge outline sky label="Sky" />
                <x-badge outline blue label="Blue" />
                <x-badge outline indigo label="Indigo" />
                <x-badge outline violet label="Violet" />
                <x-badge outline purple label="Purple" />
                <x-badge outline fuchsia label="Fuchsia" />
                <x-badge outline pink label="Pink" />
                <x-badge outline rose label="Rose" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="flat-colors" title="Flat Colors" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap items-center gap-3">
                <x-badge flat label="Default" />
                <x-badge flat primary label="Primary" />
                <x-badge flat secondary label="Secondary" />
                <x-badge flat positive label="Positive" />
                <x-badge flat negative label="Negative" />
                <x-badge flat warning label="Warning" />
                <x-badge flat info label="Info" />
                <x-badge flat dark label="Dark" />
                <div
                    class="flex justify-center p-2 bg-black border rounded-md dark:border-none dark:p-0 dark:bg-transparent">
                    <x-badge flat white label="White" />
                </div>
                <x-badge flat black label="Black" />
                <x-badge flat slate label="Slate" />
                <x-badge flat gray label="Gray" />
                <x-badge flat zinc label="Zinc" />
                <x-badge flat neutral label="Neutral" />
                <x-badge flat stone label="Stone" />
                <x-badge flat red label="Red" />
                <x-badge flat orange label="Orange" />
                <x-badge flat amber label="Amber" />
                <x-badge flat lime label="Lime" />
                <x-badge flat green label="Green" />
                <x-badge flat emerald label="Emerald" />
                <x-badge flat teal label="Teal" />
                <x-badge flat cyan label="Cyan" />
                <x-badge flat sky label="Sky" />
                <x-badge flat blue label="Blue" />
                <x-badge flat indigo label="Indigo" />
                <x-badge flat violet label="Violet" />
                <x-badge flat purple label="Purple" />
                <x-badge flat fuchsia label="Fuchsia" />
                <x-badge flat pink label="Pink" />
                <x-badge flat rose label="Rose" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="rounded-badge" title="Rounded Badge" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap gap-3">
                <x-badge rounded label="No Color" />
                <x-badge rounded primary label="Primary" />
                <x-badge rounded secondary label="Secondary" />
                <x-badge rounded positive label="Positive" />
                <x-badge rounded negative label="Negative" />
                <x-badge rounded warning label="Warning" />
                <x-badge rounded info label="Info" />
                <x-badge rounded dark label="Dark" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="squared-badge" title="Squared Badge" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap gap-3">
                <x-badge squared label="No Color" />
                <x-badge squared primary label="Primary" />
                <x-badge squared secondary label="Secondary" />
                <x-badge squared positive label="Positive" />
                <x-badge squared negative label="Negative" />
                <x-badge squared warning label="Warning" />
                <x-badge squared info label="Info" />
                <x-badge squared dark label="Dark" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="circle-badges" title="Circle Badges" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap gap-3">
                <x-badge-mini icon="home" rounded />
                <x-badge-mini primary icon="pencil" />
                <x-badge-mini secondary icon="clipboard-document-list" />
                <x-badge-mini positive icon="check" />
                <x-badge-mini negative icon="x-mark" />
                <x-badge-mini warning icon="exclamation-triangle" />
                <x-badge-mini info icon="information-circle" />
                <x-badge-mini dark icon="no-symbol" />
                <x-badge-mini secondary label="A" />
                <x-badge-mini positive label="B" />
                <x-badge-mini negative label="C" />
                <x-badge-mini primary label="+" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="badge-with-icons" title="Badge With Icons" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap gap-3">
                <x-badge icon="home" label="Default" />
                <x-badge icon="pencil" primary label="Primary" />
                <x-badge icon="clipboard-document-list" secondary label="Secondary" />
                <x-badge icon="check" positive label="Positive" />
                <x-badge icon="x-mark" negative label="Negative" />
                <x-badge icon="exclamation-triangle" warning label="Warning" />
                <x-badge right-icon="information-circle" info label="Info" />
                <x-badge right-icon="no-symbol" dark label="Dark" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="badge-sizes" title="Badge Sizes" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap items-center gap-3">
                <x-badge icon="clipboard-document-list" secondary label="default size" />
                <x-badge md icon="clipboard-document-list" positive label="md size" />
                <x-badge lg icon="clipboard-document-list" negative label="lg size" />

                <x-badge icon-size="sm" lg icon="clipboard-document-list" negative label="lg size" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="badge-prepend-and-append" title="Badge Prepend and Append" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap items-center gap-3">
                <x-badge flat primary label="Prepend">
                    <x-slot name="prepend" class="relative flex items-center w-2 h-2">
                        <span
                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-cyan-500 animate-ping"></span>
                        <span class="relative inline-flex w-2 h-2 rounded-full bg-cyan-500"></span>
                    </x-slot>
                </x-badge>

                <x-badge flat primary label="Append">
                    <x-slot name="append" class="relative flex items-center w-2 h-2">
                        <span
                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-cyan-500 animate-ping"></span>
                        <span class="relative inline-flex w-2 h-2 rounded-full bg-cyan-500"></span>
                    </x-slot>
                </x-badge>

                <x-badge flat red label="Laravel">
                    <x-slot name="append" class="relative flex items-center w-2 h-2">
                        <badge type="badge">
                            <x-icon name="x-mark" class="w-4 h-4" />
                        </badge>
                    </x-slot>
                </x-badge>
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-alert class="mb-4" warning>
        <x-slot name="title">
            The attributes [squared, rounded, full, right-icon, prepend, append] are not supported in <b>badge-mini</b>
            component
        </x-slot>
    </x-alert>

    {{-- Section --}}
    <x-docs::title id="badge-options" title="Badge Options" />

    <x-docs::table>
        <x-docs::table.row prop="md" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="lg" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="size" required="false" default="default" type="string" available="default|md|lg" />

        <x-docs::table.row prop="color" required="false" default="null" type="string" available="default colors + all tailwind colors" />

        <x-docs::table.row prop="rounded" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="squared" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="flat" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="full" required="false" default="false" type="boolean" available="boolean" />

        <x-docs::table.row prop="label" required="false" default="null" type="string" available="*" />
        <x-docs::table.row prop="icon" required="false" default="null" type="string" available="all heroicons" />
        <x-docs::table.row prop="rightIcon" required="false" default="null" type="string" available="all heroicons" />

        <x-docs::table.row prop="prepend" required="false" default="none" type="slot" available="slot" />
        <x-docs::table.row prop="append" required="false" default="none" type="slot" available="slot" />
    </x-docs::table>

    {{-- Playground --}}
    {{-- @livewire('playground.badges') --}}
</x-docs-scope>
