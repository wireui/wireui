<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#notifications" label="Notifications" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="notifications" title="Notifications" />

    <x-button wire:click="notify" primary>
        Aqui
    </x-button>

</x-docs-scope>
