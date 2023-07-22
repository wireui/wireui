<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#cards" label="Cards">
            <x-docs::summary.item href="#simple-card" label="Simple Card" />
            <x-docs::summary.item href="#card-title" label="Card Title" />
            <x-docs::summary.item href="#card-action-slot" label="Card Action Slot and Borderless" />
            <x-docs::summary.item href="#card-footer" label="Card Footer" />
        </x-docs::summary.header>

        <x-docs::summary.header href="#card-options" label="Card Options" />

        <x-docs::summary.header href="#playground" label="Playground" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="cards" title="Cards" />

    <x-docs::text>
        Cards are often used to display content in a container, restricting it to a single subject. Each card may also
        contain actions like menu or buttons.
        <br><br>
        Using cards makes the page easy to read, scan and scroll through.
    </x-docs::text>

    <x-docs::subtitle id="simple-card" title="Simple Card" />

    <x-docs::code.preview language="blade" color>
        <x-slot name="slot" class="flex justify-center gap-4">
            @verbatim
                <x-card icon-size="xl">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                    scrambled it to make a type specimen book
                </x-card>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="card-title" title="Card Title" />

    <x-docs::code.preview language="blade" color>
        <x-slot name="slot" class="flex justify-center gap-4">
            @verbatim
                <x-card title="Lorem Ipsum is simply!">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                    scrambled it to make a type specimen book
                </x-card>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="card-action-slot" title="Card Action Slot and Borderless" />

    <x-docs::code.preview language="blade" color>
        <x-slot name="slot" class="flex justify-center gap-4">
            @verbatim
                <x-card title="Lorem Ipsum is simply!" borderless>
                    <x-slot name="action">
                        <button class="rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <x-icon name="ellipsis-vertical" class="w-4 h-4 text-gray-500" />
                        </button>
                    </x-slot>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                    scrambled it to make a type specimen book
                </x-card>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="card-footer" title="Card Footer" />

    <x-docs::code.preview language="blade" color>
        <x-slot name="slot" class="flex justify-center gap-4">
            @verbatim
                <x-card title="Lorem Ipsum is simply!" rounded>
                    <x-slot name="action">
                        <button class="rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <x-icon name="ellipsis-vertical" class="w-4 h-4 text-gray-500" />
                        </button>
                    </x-slot>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                    scrambled it to make a type specimen book
                    <x-slot name="footer" class="flex items-center justify-between">
                        <x-button label="Delete" flat negative />
                        <x-button label="Save" primary />
                    </x-slot>
                </x-card>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    {{-- Section --}}
    <x-docs::title id="card-options" title="Card Options" />

    <x-docs::table :available="false">
        <x-docs::table.row prop="padding" required="false" default="px-2 py-5 md:px-4" type="string" />
        <x-docs::table.row prop="shadow" required="false" default="shadow-md" type="string" />
        <x-docs::table.row prop="rounded" required="false" default="rounded-lg" type="string" />
        <x-docs::table.row prop="color" required="false" default="bg-white dark:bg-secondary-800" type="string" />
        <x-docs::table.row prop="title" required="false" default="none" type="string" />
        <x-docs::table.row prop="borderless" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="action" required="false" default="none" type="slot" />
        <x-docs::table.row prop="header" required="false" default="none" type="slot" />
        <x-docs::table.row prop="footer" required="false" default="none" type="slot" />
    </x-docs::table>

    {{-- Playground --}}
    {{-- @livewire('playground.cards') --}}
</x-docs-scope>
