<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#checkbox" label="Checkbox">
            <x-docs::summary.item href="#simple-checkbox" label="Simple Checkbox" />
            <x-docs::summary.item href="#checkbox-with-label" label="Checkbox With Label" />
            <x-docs::summary.item href="#checkbox-sizes" label="Checkbox Sizes" />
        </x-docs::summary.header>

        <x-docs::summary.header href="#checkbox-options" label="Checkbox Options" />

        <x-docs::summary.header href="#playground" label="Playground" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="checkbox" title="Checkbox" />

    <x-docs::text>
        Checkboxes are used in forms to present the user with a list of options, allowing them to select one or more of
        these options.
    </x-docs::text>

    <x-docs::subtitle id="simple-checkbox" title="Simple Checkbox" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap gap-4">
                <x-checkbox id="input-checkbox" name="checkbox" label="Label" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="checkbox-with-label" title="Checkbox With Label" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap gap-4">
                <x-checkbox id="left-label" left-label="Label in Left" name="checkbox" />
                <x-checkbox id="right-label" label="Label in Right" name="checkbox" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="checkbox-sizes" title="Checkbox Sizes" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-col gap-4">
                <div class="flex flex-wrap gap-4">
                    <x-checkbox id="xs" name="checkbox" primary xs />
                    <x-checkbox id="sm" name="checkbox" secondary sm />
                    <x-checkbox id="md" name="checkbox" positive md />
                    <x-checkbox id="md" name="checkbox" negative md />
                    <x-checkbox id="lg" name="checkbox" warning lg />
                    <x-checkbox id="xl" name="checkbox" info xl />
                </div>

                <div class="flex flex-wrap gap-4">
                    <x-checkbox id="none" name="checkbox" xl rounded="none" />
                    <x-checkbox id="sm" name="checkbox" xl rounded="sm" />
                    <x-checkbox id="base" name="checkbox" xl rounded="base" />
                    <x-checkbox id="md" name="checkbox" xl rounded="md" />
                    <x-checkbox id="lg" name="checkbox" xl rounded="lg" />
                    <x-checkbox id="xl" name="checkbox" xl rounded="xl" />
                    <x-checkbox id="2xl" name="checkbox" xl rounded="2xl" />
                    <x-checkbox id="3xl" name="checkbox" xl rounded="3xl" />
                    <x-checkbox id="full" name="checkbox" xl rounded="full" />
                </div>
            </div>
        @endverbatim
    </x-docs::code.preview>

    {{-- Section --}}
    <x-docs::title id="checkbox-options" title="Checkbox Options" />

    <x-docs::table :available="false">
        <x-docs::table.row prop="id" required="false" default="none" type="string" />
        <x-docs::table.row prop="name" required="false" default="none" type="string" />
        <x-docs::table.row prop="label" required="false" default="none" type="string" />
        <x-docs::table.row prop="left-label" required="false" default="none" type="string" />
        <x-docs::table.row prop="md" required="false" default="false" type="bool" />
        <x-docs::table.row prop="lg" required="false" default="false" type="bool" />
    </x-docs::table>

    {{-- Playground --}}
    {{-- @livewire('playground.checkbox') --}}
</x-docs-scope>
