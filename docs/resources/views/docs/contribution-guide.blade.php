<x-docs-scope :page="$page">
    {{-- Section --}}
    <x-docs::title title="Contribution Guide" />

    <x-docs::text>
        You can contribute to the project by making a pull request on GitHub. This guide will help you get started with
        contributing to the project. I'm happy with your contribution.
    </x-docs::text>

    <x-docs::text class="mt-4">
        <b>1.</b> Create a new laravel project:
    </x-docs::text>

    <x-docs::code.block language="bash" :line-numbers="false">
        @verbatim
            composer create-project laravel/laravel wireui
        @endverbatim
    </x-docs::code.block>

    <x-docs::text class="mt-4">
        <b>2.</b> Install Livewire:
        <x-link href="https://laravel-livewire.com/docs/2.x/installation" target="_blank">Look Here</x-link>.
    </x-docs::text>

    <x-docs::text class="mt-4">
        <b>3.</b> Install Tailwind CSS:
        <x-link href="https://tailwindcss.com/docs/guides/laravel" target="_blank">Look Here</x-link>.
    </x-docs::text>

    <x-docs::text class="mt-4">
        <b>4.</b> Clone the wireui into the root of the project:
    </x-docs::text>

    <x-docs::code.block language="bash" :line-numbers="false">
        @verbatim
            git clone git@github.com:wireui/wireui.git
        @endverbatim
    </x-docs::code.block>

    <x-docs::text class="mt-4">
        <b>5.</b> Add this code into the <x-docs::mark>composer.json</x-docs::mark>:
    </x-docs::text>

    <x-docs::code.block language="json">
        @verbatim
            {
                "repositories": {
                    "wireui/wireui": {
                        "type": "path",
                        "url": "../wireui"
                    }
                }
            }
        @endverbatim
    </x-docs::code.block>

    <x-docs::text class="mt-4">
        <b>6.</b> Require WireUI:
    </x-docs::text>

    <x-docs::code.block language="bash" :line-numbers="false">
        @verbatim
            composer require wireui/wireui
        @endverbatim
    </x-docs::code.block>
</x-docs-scope>
