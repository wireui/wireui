<x-docs-scope :page="$page">
    {{-- Section --}}
    <x-docs::title title="Colors Customization" />

    <x-docs::text>
        You can customize the default colors for all WireUI components: Notifications, dialogs, inputs, selects,
        buttons...
        <br>
        You just need to extend Tailwind Colors setting in
        <x-docs::mark>tailwind.config.js</x-docs::mark>
        adding the preferred ones.
    </x-docs::text>

    <x-docs::code.block class="!mt-6" language="js">
        @verbatim
            const colors = require('tailwindcss/colors')

            module.exports = {
                ...
                theme: {
                    extend: {
                        colors: {
                            ...
                            primary: colors.indigo,
                            secondary: colors.gray,
                            positive: colors.emerald,
                            negative: colors.red,
                            warning: colors.amber,
                            info: colors.blue
                        },
                    },
                },
                ...
            }
        @endverbatim
    </x-docs::code.block>
</x-docs-scope>
