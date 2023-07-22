<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#color-picker" label="Color Picker">
            <x-docs::summary.item href="#default-colors" label="Default Colors" />
            <x-docs::summary.item href="#tailwind-colors" label="Tailwind Colors" />
            <x-docs::summary.item href="#custom-colors" label="Custom Colors" />
            <x-docs::summary.item href="#color-name-as-value" label="Color name as value" />
        </x-docs::summary.header>

        <x-docs::summary.header href="#color-picker-options" label="Color Picker Options" />

        <x-docs::summary.header href="#playground" label="Playground" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="color-picker" title="Color Picker" />

    <x-docs::text>
        The Color Picker component allows you to select a color from a palette of colors.
        You can customize the default colors or the colors for each component instance.
    </x-docs::text>

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-color-picker label="Select a Color" placeholder="Select the car color" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="default-colors" title="Default Colors" />

    <x-alert class="mb-4" info>
        <x-slot name="title">
            You can customize the default colors from the
            <x-link href="https://alpinejs.dev/globals/alpine-store" target="_blank" info>
                Alpine.js store
            </x-link>
        </x-slot>
    </x-alert>

    <x-docs::text.title title="From Alpine CDN:" />

    <x-docs::code.block language="js">
        @verbatim
            document.addEventListener('alpine:init', () => {
                Alpine.store('wireui:color-picker').setColors([
                    { name: 'White', value: '#FFF' },
                    { name: 'Black', value: '#000' },
                    { name: 'Teal',  value: '#14b8a6' },
                ])
            })
        @endverbatim
    </x-docs::code.block>

    <x-docs::text.title title="From Node Modules:" />

    <x-docs::code.block language="js">
        @verbatim
            import Alpine from 'alpinejs'

            Alpine.store('wireui:color-picker').setColors([
                { name: 'White', value: '#FFF' },
                { name: 'Black', value: '#000' },
                { name: 'Teal',  value: '#14b8a6' },
            ])

            Alpine.start()
        @endverbatim
    </x-docs::code.block>

    <x-docs::subtitle id="tailwind-colors" title="Tailwind Colors" />

    <x-alert class="mb-4" info>
        <x-slot name="title">
            If you want to use the Tailwind colors from your Tailwind CSS config, just use the code below to generate the
            new colors.
            If you are using TypeScript see
            <x-link
                href="https://github.com/wireui/wireui/blob/e3e3aff647b306ec1883c7dabec208daaa475d46/ts/components/color-picker/colors.ts"
                target="_blank" info>
                this file
            </x-link>.
        </x-slot>
    </x-alert>

    <x-docs::code.block language="js">
        @verbatim
            import Alpine from 'alpinejs'
            // update with your Tailwind config path
            import { theme } from '@/tailwind.config.js'

            // array of duplicated colors to exclude
            const excludeColors = [
                'primary',
                'secondary',
                'positive',
                'negative',
                'warning',
                'info'
            ]

            const makeColors = () => {
                const tailwindColors = theme.extend.colors ?? {}

                const colors = Object.entries(tailwindColors).flatMap(([name, values]) => {
                    if (typeof values === 'string' || excludeColors.includes(name)) {
                        return []
                    }

                    return Object.entries(values).map(([tonality, hex]) => ({
                        name: `${name}-${tonality}`,
                        value: hex
                    }))
                })

                colors.push({ name: 'White', value: '#fff' })
                colors.push({ name: 'Black', value: '#000' })

                return colors
            }

            Alpine.store('wireui:color-picker').setColors(makeColors())
        @endverbatim
    </x-docs::code.block>

    <x-alert title="Attention" class="mb-4" warning>
        Remember to pass a correct colors options into the component attributes.
    </x-alert>

    <x-docs::subtitle id="custom-colors" title="Custom Colors" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            @verbatim
                <x-color-picker label="Select a Color" placeholder="Select the book color" :colors="[
                    ['name' => 'White', 'value' => '#FFF'],
                    ['name' => 'Black', 'value' => '#000'],
                    ['name' => 'Teal', 'value' => '#14b8a6'],
                    ['name' => 'Slate', 'value' => '#64748b'],
                    ['name' => 'Red', 'value' => '#ef4444'],
                    ['name' => 'Lime', 'value' => '#a3e635'],
                    ['name' => 'Sky', 'value' => '#38bdf8'],
                    ['name' => 'Violet', 'value' => '#8b5cf6'],
                    ['name' => 'Pink', 'value' => '#8b5cf6'],
                    ['name' => 'Indigo', 'value' => '#6366f1'],
                ]" />

                <x-color-picker label="Select a Color" placeholder="Select the book color" :colors="[
                    '#FFF',
                    '#000',
                    '#14b8a6',
                    '#64748b',
                    '#ef4444',
                    '#a3e635',
                    '#38bdf8',
                    '#8b5cf6',
                    '#8b5cf6',
                    '#6366f1',
                ]" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="color-name-as-value" title="Color name as value" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm mx-auto">
            @verbatim
                <x-color-picker label="Select a Color" placeholder="Select the book color" color-name-as-value />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    {{-- Section --}}
    <x-docs::title id="color-picker-options" title="Color Picker Options" />

    <x-docs::text>
        The Color Picker component receives all options from the
        <x-link href="{{ route('docs.index', 'inputs') }}#input-options">input component</x-link>,
        except the prefix, icon and the slots prepend and append.
    </x-docs::text>

    <x-docs::table class="!mt-6" :available="false">
        <x-docs::table.row prop="colors" required="false" default="all tailwind colors" type="array|Collection" />
    </x-docs::table>

    {{-- Playground --}}
    {{-- @livewire('playground.color-picker') --}}
</x-docs-scope>
