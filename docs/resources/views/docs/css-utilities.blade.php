<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#css-utlitites" label="CSS Utilities">
            <x-docs::summary.item href="#hide-scrollbar" label="Hide Scrollbar" />
            <x-docs::summary.item href="#soft-scrollbar" label="Soft Scrollbar" />
        </x-docs::summary.header>
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="css-utlitites" title="CSS Utilities" />

    <x-docs::text>
        Some css utilities used in the WireUI components that should be useful for all developers.
    </x-docs::text>

    <x-docs::subtitle id="hide-scrollbar" title="Hide Scrollbar" />

    <x-alert class="mb-4" info>
        <x-slot name="title">
            You can hide the scrollbar by adding the <b>.hide-scrollbar</b> CSS class.
            <br>
            You can scroll the content pressing shift + mouse wheel.
        </x-slot>
    </x-alert>

    <x-docs::code.preview language="html">
        <x-slot name="slot" class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            @verbatim
                <div class="w-full p-2 overflow-x-auto h-52">
                    <div class="relative flex items-center border rounded-lg shadow-lg h-44 bg-negative-500"
                        style="width: 900px">
                        <div class="absolute w-full h-8 border-white border-dashed border-y-8"></div>
                    </div>
                </div>

                <div class="w-full p-2 overflow-x-auto h-52 hide-scrollbar">
                    <div class="relative flex items-center border rounded-lg shadow-lg h-44 bg-positive-500"
                        style="width: 900px">
                        <div class="absolute w-full h-8 border-white border-dotted border-y-8"></div>
                    </div>
                </div>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="soft-scrollbar" title="Soft Scrollbar" />

    <x-alert class="mb-4" info>
        <x-slot name="title">
            You can change the scrollbar by adding the <b>.soft-scrollbar</b> CSS class.
        </x-slot>
    </x-alert>

    <x-docs::code.preview language="html">
        <x-slot name="slot" class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            @verbatim
                <div class="w-full p-2 overflow-x-auto h-52">
                    <div class="relative flex items-center border rounded-lg shadow-lg h-44 bg-negative-500"
                        style="width: 900px">
                        <div class="absolute w-full h-8 border-white border-dashed border-y-8"></div>
                    </div>
                </div>

                <div class="w-full p-2 overflow-x-auto h-52 soft-scrollbar">
                    <div class="relative flex items-center border rounded-lg shadow-lg h-44 bg-positive-500"
                        style="width: 900px">
                        <div class="absolute w-full h-8 border-white border-dotted border-y-8"></div>
                    </div>
                </div>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>
</x-docs-scope>
