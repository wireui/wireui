<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#modal" label="Modal">
            <x-docs::summary.item href="#simple-modal" label="Simple Modal" />
            <x-docs::summary.item href="#blur-background" label="Blur Background" />
            <x-docs::summary.item href="#modal-card" label="Modal Card" />
        </x-docs::summary.header>

        <x-docs::summary.header href="#modal-options" label="Modal Options" />

        <x-docs::summary.header href="#modal-card-options" label="Modal Card Options" />

        <x-docs::summary.header href="#modal-events" label="Modal Events" />

        <x-docs::summary.header href="#customize-default" label="Customize Default" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="modal" title="Modal" />

    <x-docs::subtitle id="simple-modal" title="Simple Modal" />

    <x-docs::code.preview language="blade">
        @verbatim
            <x-button label="Open" x-on:click="$openModal('simpleModal')" primary />

            <x-modal name="simpleModal">
                <x-card title="Consent Terms">
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                        <br><br><br><br>
                        industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                        <br><br><br><br>
                        and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                        <br><br><br><br>
                        leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s
                        <br><br><br><br>
                        with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                        <br><br><br><br>
                        publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>

                    <x-slot name="footer" class="flex justify-end gap-x-4">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="I Agree" x-on:click="close" />
                    </x-slot>
                </x-card>
            </x-modal>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="blur-background" title="Blur Background" />

    <x-docs::code.preview language="blade">
        @verbatim
            <x-button label="Open" wire:click="openBlur" primary />

            <x-modal name="blurModal" blur>
                <x-card title="Consent Terms">
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                        and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                        leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s
                        with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                        publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>

                    <x-slot name="footer" class="flex justify-end gap-x-4">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button wire:click="closeBlur" primary label="I Agree" x-on:click="close" />
                    </x-slot>
                </x-card>
            </x-modal>
        @endverbatim
    </x-docs::code.preview>

    <x-alert class="mb-4" info>
        <x-slot name="title">
            Tip: If your project has a custom main element that handles the scroll, you can use the
            <b>main-container</b> attribute in your main element to block the scroll when the modal is opened.
        </x-slot>
    </x-alert>

    <x-docs::subtitle id="modal-card" title="Modal Card" />

    <x-docs::code.preview language="blade">
        @verbatim
            {{-- <x-button label="Open" x-on:click="$openModal('cardModal')" primary />

            <x-modal.card title="Edit Customer" blur show name="cardModal">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-input label="Name" placeholder="Your full name" />

                    <x-input label="Phone" placeholder="USA phone" />

                    <div class="col-span-1 sm:col-span-2">
                        <x-input label="Email" placeholder="example@mail.com" />
                    </div>

                    <div
                        class="flex items-center justify-center col-span-1 bg-gray-100 shadow-md cursor-pointer sm:col-span-2 dark:bg-secondary-700 rounded-xl h-72">
                        <div class="flex flex-col items-center justify-center">
                            <x-icon name="cloud-arrow-up" class="w-16 h-16 text-blue-600 dark:text-teal-600" />
                            <p class="text-blue-600 dark:text-teal-600">Click or drop files here</p>
                        </div>
                    </div>
                </div>

                <x-slot name="footer" class="flex justify-between gap-x-4">
                    <x-button flat negative label="Delete" x-on:click="close" />

                    <div class="flex gap-x-4">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="Save" x-on:click="close" />
                    </div>
                </x-slot>
            </x-modal.card> --}}
        @endverbatim
    </x-docs::code.preview>

    <x-alert class="mb-4" info>
        <x-slot name="title">
            Tip: You can use the global function
            <b>$openModal('myModal')</b>
            to open modal from your JavaScript code.
        </x-slot>
    </x-alert>

    {{-- Section --}}
    <x-docs::title id="modal-options" title="Modal Options" />

    <x-docs::table>
        <x-docs::table.row prop="name" required="false" default="none" type="string" available="*" />
        <x-docs::table.row prop="z-index" required="false" default="z-50" type="string" available="all z-index" />
        <x-docs::table.row prop="max-width" required="false" default="2xl" type="string" available="sm|md|lg|xl|2xl|3xl|4xl|5xl|6xl" />
        <x-docs::table.row prop="spacing" required="false" default="p-4" type="string" available="all paddings" />
        <x-docs::table.row prop="align" required="false" default="start" type="string" available="start|center|end" />
        <x-docs::table.row prop="blur" required="false" default="none" type="string" available="sm|md|lg|xl|2xl|3xl" />
        <x-docs::table.row prop="show" required="false" default="none" type="boolean" available="true|false" />
    </x-docs::table>

    {{-- Section --}}
    <x-docs::title id="modal-card-options" title="Modal Card Options" />

    <x-docs::text>
        The modal card options extends all modal and
        <x-link :href="route('docs.index', 'cards')">card options</x-link>.
    </x-docs::text>

    <x-docs::table :available="false">
        <x-docs::table.row prop="squared" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="fullscreen" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="hide-close" required="false" default="false" type="boolean" available="--" />
    </x-docs::table>

    {{-- Section --}}
    <x-docs::title id="modal-events" title="Modal Events" />

    <x-docs::code.block language="blade" />

    {{-- Section --}}
    <x-docs::title id="customize-default" title="Customize Default" />

    <x-docs::text>
        You can
        <x-link href="{{ route('docs.index', 'installation') }}#publishing">publish</x-link>
        the WireUI config or put in the .env file your modal preferences.
    </x-docs::text>

    <x-docs::code.block language="php" />
</x-docs-scope>
