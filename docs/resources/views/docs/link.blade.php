<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#link" label="Links">
            <x-docs::summary.item href="#simple-link" label="Simple Link" />
        </x-docs::summary.header>

        <x-docs::summary.header href="#link-options" label="Link Options" />

        <x-docs::summary.header href="#playground" label="Playground" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="links" title="Links" />

    <x-docs::text>
        Links.
    </x-docs::text>

    <x-docs::subtitle id="simple-link" title="Simple Link" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="flex flex-col items-center space-y-4">
            @verbatim
                <x-link label="Link" href="#" />

                <x-link label="Link" href="#" amber />

                <x-link label="Link" href="#" md />

                <x-link label="Link" href="#" lg />

                <x-link label="Link" wire:click="$refresh" />

                <x-link label="Link" href="#" target="_blank" />

                <x-link label="None" href="#" lg underline="none" />

                <x-link label="Hover" href="#" lg underline="hover" />

                <x-link label="Always" href="#" lg underline="always" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    {{-- Section --}}
    <x-docs::title id="links-options" title="Links Options" />

    {{-- <x-docs::table :available="false">
        <x-docs::table.row prop="title" required="false" default="none" type="string" />
        <x-docs::table.row prop="icon" required="false" default="none" type="string" />
        <x-docs::table.row prop="padding" required="false" default="pl-1 mt-2 ml-5" type="string" />
        <x-docs::table.row prop="shadow" required="false" default="shadow-md" type="string" />
        <x-docs::table.row prop="rounded" required="false" default="rounded-lg" type="string" />
        <x-docs::table.row prop="color" required="false" default="primary or set in config" type="string" />
        <x-docs::table.row prop="borderless" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="iconless" required="false" default="false" type="bool" />
        <x-docs::table.row prop="action" required="false" default="none" type="slot" />
        <x-docs::table.row prop="header" required="false" default="none" type="slot" />
        <x-docs::table.row prop="footer" required="false" default="none" type="slot" />
    </x-docs::table> --}}

    {{-- Playground --}}
    {{-- @livewire('playground.links') --}}
</x-docs-scope>
