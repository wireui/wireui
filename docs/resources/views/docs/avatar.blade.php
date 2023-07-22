<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#avatar" label="Avatar">
            <x-docs::summary.item href="#avatar-image" label="Avatar Image" />
            <x-docs::summary.item href="#avatar-label" label="Avatar Label" />
            <x-docs::summary.item href="#avatar-squared" label="Avatar Squared" />
            <x-docs::summary.item href="#avatar-sizes" label="Avatar Sizes" />
            <x-docs::summary.item href="#avatar-group" label="Avatar Group" />
            <x-docs::summary.item href="#avatar-placeholder" label="Placeholder" />
        </x-docs::summary.header>

        <x-docs::summary.header href="#avatar-options" label="Avatar Options" />

        <x-docs::summary.header href="#playground" label="Playground" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="avatar" title="Avatar" />

    <x-docs::text>
        The avatar component will display an image, a label, or a default SVG placeholder.
        <br>
        You can use this component to build your features like profile pictures.
    </x-docs::text>

    <x-docs::subtitle id="avatar-image" title="Avatar Image" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="flex items-center gap-x-3">
            @verbatim
                <x-avatar xs warning :src="Vite::file('avatar/pedro.jpg')" />
                <x-avatar sm primary :src="Vite::file('avatar/fernando.jpeg')" />
                <x-avatar md :src="Vite::file('avatar/andre.jpeg')" />
                <x-avatar lg :src="Vite::file('avatar/keithyellen.jpg')" />
                <x-avatar xl :src="Vite::file('avatar/pedro.jpg')" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="avatar-label" title="Avatar Label" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap items-center gap-3">
                <x-avatar xs label="AB" />
                <x-avatar sm label="AB" />
                <x-avatar md label="AB" />
                <x-avatar lg label="AB" />
                <x-avatar xl label="AB" />

                <x-avatar xl>
                    <x-slot name="label" class="!text-rose-300">
                        AB
                    </x-slot>
                </x-avatar>
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="avatar-squared" title="Avatar Squared" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap items-center gap-3">
                <x-avatar xl squared :src="Vite::file('avatar/pedro.jpg')" />
                <x-avatar xl rounded="sm" :src="Vite::file('avatar/fernando.jpeg')" />
                <x-avatar xl rounded="base" :src="Vite::file('avatar/andre.jpeg')" />
                <x-avatar xl rounded="md" :src="Vite::file('avatar/keithyellen.jpg')" />
                <x-avatar xl rounded="lg" :src="Vite::file('avatar/pedro.jpg')" />
                <x-avatar xl rounded="xl" :src="Vite::file('avatar/fernando.jpeg')" />
                <x-avatar xl rounded="2xl" :src="Vite::file('avatar/andre.jpeg')" />
                <x-avatar xl rounded="3xl" :src="Vite::file('avatar/keithyellen.jpg')" />
                <x-avatar xl rounded="full" :src="Vite::file('avatar/pedro.jpg')" />
            </div>
        @endverbatim
    </x-docs::code.preview>


    <x-alert class="mb-4" info>
        <x-slot name="title">
            You can customize the avatar
            <x-docs::mark>size</x-docs::mark>
            by adding the size css classes into the size attribute.
        </x-slot>
    </x-alert>

    <x-docs::subtitle id="avatar-sizes" title="Avatar Sizes" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap items-center gap-3">
                <x-avatar xs label="AB" />
                <x-avatar sm label="AB" info border="border-4" />
                <x-avatar md label="AB" negative border="border-4" />
                <x-avatar lg label="AB" warning border="border-4" />
                <x-avatar xl label="AB" positive border="border-4" />
                <x-avatar 2xl label="AB" primary border="border-4" />
                <x-avatar 3xl :src="Vite::file('avatar/pedro.jpg')" border="border-8" :color="[
                    'label'  => 'bg-primary-500 dark:bg-primary-600',
                    'border' => 'border-secondary-900 dark:border-primary-100',
                ]" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-docs::subtitle id="avatar-group" title="Avatar Group" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex items-center -space-x-2">
                <x-avatar sm :src="Vite::file('avatar/fernando.jpeg')" />
                <x-avatar sm :src="Vite::file('avatar/andre.jpeg')" />
                <x-avatar sm :src="Vite::file('avatar/keithyellen.jpg')" />
                <x-avatar sm :src="Vite::file('avatar/pedro.jpg')" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    <x-alert class="mb-4" info>
        <x-slot name="title">
            If no text and no img is given, the avatar will display a default SVG placeholder.
        </x-slot>
    </x-alert>

    <x-docs::subtitle id="avatar-placeholder" title="Avatar Placeholder" />

    <x-docs::code.preview language="blade">
        @verbatim
            <div class="flex flex-wrap items-center gap-3">
                <x-avatar xs info icon="arrow-up-on-square-stack" />
                <x-avatar sm negative icon="arrow-up-on-square-stack" />
                <x-avatar md warning icon="arrow-up-on-square-stack" />
                <x-avatar lg positive icon="arrow-up-on-square-stack" />
                <x-avatar xl primary icon="arrow-up-on-square-stack" />
                <x-avatar 2xl icon="arrow-up-on-square-stack" />
                <x-avatar 3xl icon="arrow-up-on-square-stack" />
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <x-avatar xs info />
                <x-avatar sm negative />
                <x-avatar md warning />
                <x-avatar lg positive />
                <x-avatar xl primary />
                <x-avatar 2xl />
                <x-avatar 3xl />
                <x-avatar 3xl size="w-28 h-28" :icon-size="[
                    'icon' => 'w-20 h-20',
                    // 'label' => 'text-4xl',
                ]" />
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <x-avatar xs info label="AB" />
                <x-avatar sm negative label="AB" />
                <x-avatar md warning label="AB" />
                <x-avatar lg positive label="AB" />
                <x-avatar xl primary label="AB" />
                <x-avatar 2xl label="AB" />
                <x-avatar 3xl label="AB" />

                <x-avatar label="AB" size="w-28 h-28" :icon-size="[
                    // 'icon' => 'w-24 h-24',
                    'label' => 'text-4xl',
                ]" />
            </div>
        @endverbatim
    </x-docs::code.preview>

    {{-- Section --}}
    <x-docs::title id="avatar-options" title="Avatar Options" />

    <x-docs::table :available="false">
        <x-docs::table.row prop="xs" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="sm" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="md" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="lg" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="xl" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="squared" required="false" default="false" type="boolean" />
        <x-docs::table.row prop="size" required="false" default="md" type="string|null" />
        <x-docs::table.row prop="label" required="false" default="null" type="string|null" />
        <x-docs::table.row prop="src" required="false" default="null" type="string|null" />
        <x-docs::table.row prop="border" required="false" default="border border-gray-200 dark:border-secondary-500" type="string|null" />
    </x-docs::table>

    {{-- Playground --}}
    {{-- @livewire('playground.avatar') --}}
</x-docs-scope>
