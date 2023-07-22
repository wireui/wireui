<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#errors" label="Errors">
            <x-docs::summary.item href="#all-errors" label="All Errors" />
            <x-docs::summary.item href="#filtered-errors" label="Filtered Errors" />
            <x-docs::summary.item href="#custom-title" label="Custom Title" />
            <x-docs::summary.item href="#change-icon-and-borderless" label="Change Icon and Borderless" />
            <x-docs::summary.item href="#without-icon" label="Without Icon" />
            <x-docs::summary.item href="#error-footer" label="Error Footer" />
        </x-docs::summary.header>

        <x-docs::summary.header href="#errors-options" label="Errors Options" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="errors" title="Errors" />

    <x-docs::text>
        The Errors component is useful for displaying errors in a friendly way.
        <br><br>
        We can find this component often combined with the
        <x-link href="{{ route('docs.index', 'inputs') }}">inputs</x-link>
        component to report validation errors.
    </x-docs::text>

    <x-alert class="mt-6 mb-4" info>
        <x-slot name="title">
            Tip: You can customize the default error messages in the language translation files.
        </x-slot>
    </x-alert>

    <x-docs::subtitle id="all-errors" title="All Errors" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-lg mx-auto">
            @verbatim
                <x-errors color="primary">
                    <x-slot name="title">
                        AAAAA <b>{errors}</b> BBBBB
                    </x-slot>
                </x-errors>
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="filtered-errors" title="Filtered Errors" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="max-w-lg mx-auto">
                <x-errors only="name" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="custom-title" title="Custom Title" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="max-w-lg mx-auto">
                <x-errors title="We found {errors} validation error(s)" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-alert class="mb-4" info>
        <x-slot name="title">
            Tip: The key <b>{errors}</b> will be replaced with the number of error messages.
        </x-slot>
    </x-alert>

    <x-docs::subtitle id="change-icon-and-borderless" title="Change Icon and Borderless" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="max-w-lg mx-auto">
                <x-errors icon="x-mark" borderless />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="without-icon" title="Without Icon" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="max-w-lg mx-auto">
                <x-errors iconless />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="error-footer" title="Error Footer" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="max-w-lg mx-auto">
                <x-errors>
                    <x-slot name="footer" class="flex items-center justify-end">
                        <x-button sm label="Close" flat negative />
                    </x-slot>
                </x-errors>
            </div>
        @endverbatim
    </x-docs::code.preview>

    {{-- Section --}}
    <x-docs::title id="errors-options" title="Errors Options" />

    <x-docs::table :available="false">
        <x-docs::table.row prop="title" required="false" default="[...]" type="string" />
        <x-docs::table.row prop="only" required="false" default="none" type="string|array" />
        <x-docs::table.row prop="icon" required="false" default="none" type="string" />
        <x-docs::table.row prop="borderless" required="false" default="none" type="bool" />
        <x-docs::table.row prop="iconless" required="false" default="false" type="bool" />
        <x-docs::table.row prop="action" required="false" default="none" type="slot" />
        <x-docs::table.row prop="footer" required="false" default="none" type="slot" />
    </x-docs::table>
</x-docs-scope>
