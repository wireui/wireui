<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#dropdown" label="Dropdown">
            <x-docs::summary.item href="#simple-dropdown" label="Simple Dropdown" />
            <x-docs::summary.item href="#header-dropdown" label="Header Dropdown" />
            <x-docs::summary.item href="#separator-dropdown" label="Separator Dropdown" />
            <x-docs::summary.item href="#item-icon" label="Item Icon" />
            <x-docs::summary.item href="#trigger-slot" label="Trigger Slot" />
            <x-docs::summary.item href="#item-slot" label="Item Slot" />
        </x-docs::summary.header>

        <x-docs::summary.header href="#dropdown-options" label="Dropdown Options" />

        <x-docs::summary.header href="#dropdown-header-options" label="Dropdown Header Options" />

        <x-docs::summary.header href="#dropdown-item-options" label="Dropdown Item Options" />

        <x-docs::summary.header href="#playground" label="Playground" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="dropdown" title="Dropdown" />

    <x-docs::subtitle id="simple-dropdown" title="Simple Dropdown" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="flex flex-wrap gap-4">
            @verbatim
                <x-dropdown align="left">
                    <x-dropdown.item label="Settings" />
                    <x-dropdown.item label="My Profile" />
                    <x-dropdown.item label="Logout" />
                </x-dropdown>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="header-dropdown" title="Header Dropdown" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="flex flex-wrap gap-4">
            @verbatim
                <x-dropdown align="left">
                    <x-dropdown.header label="Settings">
                        <x-dropdown.item label="Preferences" />
                        <x-dropdown.item label="My Profile" />
                    </x-dropdown.header>

                    <x-dropdown.item label="Logout" />
                </x-dropdown>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="separator-dropdown" title="Separator Dropdown" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="flex flex-wrap gap-4">
            @verbatim
                <x-dropdown align="left">
                    <x-dropdown.header label="Settings">
                        <x-dropdown.item label="Preferences" />
                        <x-dropdown.item label="My Profile" />
                    </x-dropdown.header>

                    <x-dropdown.item separator label="Help Center" />
                    <x-dropdown.item label="Live Chat" />
                    <x-dropdown.item label="Logout" />
                </x-dropdown>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="item-icon" title="Item Icon" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="flex flex-wrap gap-4">
            @verbatim
                <x-dropdown align="left">
                    <x-dropdown.header label="Settings">
                        <x-dropdown.item icon="cog" label="Preferences" />
                        <x-dropdown.item icon="user" label="My Profile" />
                    </x-dropdown.header>

                    <x-dropdown.item separator label="Help Center" />
                    <x-dropdown.item label="Live Chat" />
                    <x-dropdown.item label="Logout" />
                </x-dropdown>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="trigger-slot" title="Trigger Slot" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="flex flex-wrap gap-4">
            @verbatim
                <x-dropdown align="left">
                    <x-slot name="trigger">
                        <x-button label="Options" primary />
                    </x-slot>

                    <x-dropdown.item label="Help Center" />
                    <x-dropdown.item separator label="Live Chat" />
                    <x-dropdown.item separator label="Logout" />
                </x-dropdown>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="item-slot" title="Item Slot" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="flex flex-wrap gap-4">
            @verbatim
                <x-dropdown align="left">
                    <x-dropdown.item>
                        <b>Help Center</b>
                    </x-dropdown.item>
                    <x-dropdown.item separator>
                        <b>Live Chat</b>
                    </x-dropdown.item>
                    <x-dropdown.item separator>
                        <b>Logout</b>
                    </x-dropdown.item>
                </x-dropdown>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    {{-- Section --}}
    <x-docs::title id="dropdown-options" title="Dropdown Options" />

    <x-docs::table>
        <x-docs::table.row prop="width" required="false" default="w-48" type="string" available="-" />
        <x-docs::table.row prop="align" required="false" default="right" type="string" available="left|right" />
        <x-docs::table.row prop="persistent" required="false" default="false" type="boolean" available="-" />
        <x-docs::table.row prop="trigger" required="false" default="dots-vertical icon" type="slot" available="-" />
    </x-docs::table>

    {{-- Section --}}
    <x-docs::title id="dropdown-header-options" title="Dropdown Header Options" />

    <x-docs::table :available="false">
        <x-docs::table.row prop="separator" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="label" required="true" default="none" type="string" />
        <x-docs::table.row prop="slot" required="false" default="none" type="slot" />
    </x-docs::table>

    {{-- Section --}}
    <x-docs::title id="dropdown-item-options" title="Dropdown Item Options" />

    <x-docs::table :available="false">
        <x-docs::table.row prop="separator" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="label" required="true" default="none" type="string" />
        <x-docs::table.row prop="icon" required="false" default="none" type="string" />
        <x-docs::table.row prop="slot" required="false" default="none" type="slot" />
    </x-docs::table>

    {{-- Playground --}}
    {{-- @livewire('playground.dropdowm') --}}
</x-docs-scope>
