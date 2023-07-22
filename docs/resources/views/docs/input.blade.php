<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#inputs" label="Inputs">
            <x-docs::summary.item href="#simple-input" label="Simple Input" />
            <x-docs::summary.item href="#input-hint" label="Input Hint" />
            <x-docs::summary.item href="#input-corner-hint" label="Input Corner Hint" />
            <x-docs::summary.item href="#input-icon" label="Input Icon" />
            <x-docs::summary.item href="#input-right-icon" label="Input Right Icon" />
            <x-docs::summary.item href="#two-icons-input" label="Two Icons Input" />
            <x-docs::summary.item href="#input-prefix" label="Input Prefix" />
            <x-docs::summary.item href="#input-suffix" label="Input Suffix" />
            <x-docs::summary.item href="#input-prepend" label="Input Prepend" />
            <x-docs::summary.item href="#input-append" label="Input Append" />
        </x-docs::summary.header>

        <x-docs::summary.header href="#input-options" label="Inputs Options" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="inputs" title="Inputs" />

    <x-docs::text>
        The Input component is very useful to build forms.
        <br><br>
        You can set the attribute <x-docs::mark>wire:model</x-docs::mark>
        to automatically have the attributes <x-docs::mark>id</x-docs::mark>
        set to the MD5 of the model and <x-docs::mark>name</x-docs::mark>
        to the exact model. You must NOT pass the attributes id and name for this to work.
    </x-docs::text>

    <x-docs::code.block language="blade">
        @verbatim
            <x-input wire:model="firstName" label="Name" placeholder="User's first name" />
        @endverbatim
    </x-docs::code.block>

    <x-alert class="mb-4" info>
        <x-slot name="title">
            Tip: You can use the
            <x-link :href="route('docs.index', 'errors')" color="info">Errors component</x-link>
            to display validation error messages for your input.
        </x-slot>
    </x-alert>

    <x-docs::subtitle id="simple-input" title="Simple Input" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-input label="Name" placeholder="your name" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="input-hint" title="Input Hint" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-input label="Name" placeholder="your name" hint="Inform your full name" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="input-corner-hint" title="Input Corner Hint" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-input label="Name" placeholder="your name" corner-hint="Ex: John" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="input-icon" title="Input Icon" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-input icon="user" label="Name" placeholder="your name" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="input-right-icon" title="Input Right Icon" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-input right-icon="user" label="Name" placeholder="your name" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="two-icons-input" title="Two Icons Input" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-input icon="user" right-icon="pencil" label="Name" placeholder="your name" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="input-prefix" title="Input Prefix" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-input class="!pl-[6.5rem]" label="Website" placeholder="your-website.com" prefix="https://www." />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="input-suffix" title="Input Suffix" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-input class="pr-28" label="Email" placeholder="your email" suffix="@mail.com" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="input-prepend" title="Input Prepend" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-input label="Name" placeholder="your name" class="pl-12">
                    <x-slot name="prepend">
                        <div class="absolute inset-y-0 left-0 flex items-center p-0.5">
                            <x-button class="h-full rounded-l-md" icon="bars-arrow-up" primary flat squared />
                        </div>
                    </x-slot>
                </x-input>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="input-append" title="Input Append" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-input label="Name" placeholder="your name">
                    <x-slot name="append">
                        <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                            <x-button class="h-full rounded-r-md" icon="bars-arrow-up" primary flat squared />
                        </div>
                    </x-slot>
                </x-input>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    {{-- Section --}}
    <x-docs::title id="input-options" title="Input Options" />

    <x-docs::table :available="false">
        <x-docs::table.row prop="label" required="false" default="none" type="string" />
        <x-docs::table.row prop="hint" required="false" default="none" type="string" />
        <x-docs::table.row prop="cornerHint" required="false" default="none" type="string" />
        <x-docs::table.row prop="icon" required="false" default="none" type="string" />
        <x-docs::table.row prop="rightIcon" required="false" default="none" type="string" />
        <x-docs::table.row prop="prefix" required="false" default="none" type="string" />
        <x-docs::table.row prop="suffix" required="false" default="none" type="string" />
        <x-docs::table.row prop="prepend" required="false" default="none" type="slot" />
        <x-docs::table.row prop="append" required="false" default="none" type="slot" />
    </x-docs::table>


    {{-- Playground --}}
    {{-- @livewire('playground.inputs') --}}
</x-docs-scope>
