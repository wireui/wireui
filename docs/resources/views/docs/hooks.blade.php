<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#wireui-hooks" label="WireUi Hooks" />

        <x-docs::summary.header href="#available-hooks" label="Available Hooks" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="wireui-hooks" title="WireUi Hooks" />

    <x-docs::text>
        WireUI Hooks is a simple way to perform actions at determinate moments.
        It is possible to fire a notification when a Notification component is ready,
        or call a Livewire action when WireUi is loaded.
        See available hooks bellow
    </x-docs::text>

    {{-- Section --}}
    <x-docs::title id="available-hooks" title="Available Hooks" />

    <x-docs::text>
        WireUI Hooks is a simple way to perform actions at determinate moments.
        It is possible to fire a notification when a Notification component is ready,
        or call a Livewire action when WireUi is loaded.
        See available hooks bellow
    </x-docs::text>

    <x-docs::code.block language="js">
        @verbatim
            Wireui.hook('load', () => console.log('wireui is ready to use'))

            Wireui.hook('notifications:load', () => {
                $wireui.notify({
                    title: 'Profile saved!',
                    description: 'Your profile was successfully saved',
                    icon: 'success'
                })
            })

            Wireui.hook('dialog:load', () => {
                $wireui.dialog({
                    title: 'Profile saved!',
                    description: 'Your profile was successfully saved',
                    icon: 'success'
                })
            })

            Or custom dialog hook

            Wireui.hook('dialog:custom:load', () => {})
        @endverbatim
    </x-docs::code.block>
</x-docs-scope>
