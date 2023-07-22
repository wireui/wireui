<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#heroicons" label="Heroicons" />

        <x-docs::summary.header href="#options" label="Options" />

        <x-docs::summary.header href="#playground" label="Playground" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="heroicons" title="Heroicons" />

    <x-docs::text>
        All
        <x-link :href="config('docs.links.heroicons')" target="_blank">Heroicons</x-link>
        icons are available using the component:
    </x-docs::text>

    <x-docs::code.block language="blade">
        @verbatim
            <x-icon name="home" class="w-5 h-5" />
            <x-icon name="home" class="w-5 h-5" mini />
            <x-icon name="home" class="w-5 h-5" solid />
            <x-icon name="home" class="w-5 h-5" outline />

            <x-heroicons::outline.user />
            <x-heroicons::solid.user />
            <x-heroicons::mini.solid.user class="w-5 h-5" />
        @endverbatim
    </x-docs::code.block>

    <x-docs::text>
        You can publish the icon configuration and define what will be the default variant
    </x-docs::text>

    <x-docs::code.block language="bash">
        @verbatim
            php artisan vendor:publish --tag='wireui.config'
        @endverbatim
    </x-docs::code.block>

    {{-- Section --}}
    <x-docs::title id="options" title="Options" />

    <x-docs::table>
        <x-docs::table.row prop="name" required="true" default="none" type="string" available="all heroicons" />
        <x-docs::table.row prop="variant" required="false" default="outline" type="string" available="outline|solid|mini" />
        <x-docs::table.row prop="mini" required="false" default="false" type="boolean" available="true|false" />
        <x-docs::table.row prop="solid" required="false" default="false" type="boolean" available="true|false" />
        <x-docs::table.row prop="outline" required="false" default="false" type="boolean" available="true|false" />
    </x-docs::table>

    {{-- Playground --}}
    {{-- @livewire('playground.icons') --}}
</x-docs-scope>
