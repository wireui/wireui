<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#dialogs" label="Dialogs" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="dialogs" title="Dialogs" />

    <x-button wire:click="dialog" primary>
        Aqui
    </x-button>

    <x-docs::code.block language="blade" render>
        @verbatim
            <x-dialog id="custom" title="User information" description="Complete your profile, give your name">
                <x-input label="What's your name?" placeholder="your name bro" x-model="name" />
            </x-dialog>
        @endverbatim
    </x-docs::code.block>

</x-docs-scope>
