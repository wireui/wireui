<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#meet-wireui" label="Meet WireUI" />

        <x-docs::summary.header href="#requirements" label="Requirements" />

        <x-docs::summary.header href="#installation" label="Installation" />

        <x-docs::summary.header href="#publishing" label="Publishing" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="meet-wireui" title="Meet WireUI" />

    <x-docs::text>
        The WireUI is a library of components and resources to empower your application development with Laravel and
        Livewire. Starting a new project with Livewire can be time-consuming when you have to create all the components
        from scratch. Wire UI helps to skip this step and get you straight to the development phase.
        <br><br>
        Installing WireUI enriches your project with:
    </x-docs::text>

    <x-docs::list>
        <x-docs::list.item text="Form and UI components" />

        <x-docs::list.item text="Notifications" />

        <x-docs::list.item text="Confirmation notifications" />

        <x-docs::list.item text="All Heroicons" href="#" />
    </x-docs::list>

    {{-- Section --}}
    <x-docs::title id="requirements" title="Requirements" />

    <x-docs::list>
        <x-docs::list.item>
            <x-link href="https://www.php.net" label="PHP 7.4.x | 8.x" target="_blank" underline="none"/>
        </x-docs::list.item>

        <x-docs::list.item>
            <x-link href="https://getcomposer.org" label="Composer" target="_blank" underline="none"/>
        </x-docs::list.item>

        <x-docs::list.item>
            <x-link href="https://laravel.com" label="Laravel 8.x" target="_blank" underline="none"/>
        </x-docs::list.item>

        <x-docs::list.item>
            <x-link href="https://laravel-livewire.com" label="Livewire 2.5 or above" target="_blank" underline="none"/>
        </x-docs::list.item>

        <x-docs::list.item>
            <x-link href="https://alpinejs.dev" label="Alpine.js 3.x" target="_blank" underline="none"/>
        </x-docs::list.item>

        <x-docs::list.item>
            <x-link href="https://tailwindcss.com" label="Tailwindcss 3.x" target="_blank" underline="none"/>
        </x-docs::list.item>

        <x-docs::list.item>
            <x-link href="https://tailwindcss.com/docs/plugins#aspect-ratio" label="@tailwindcss/aspect-ratio 0.4.x" target="_blank" underline="none"/>
        </x-docs::list.item>

        <x-docs::list.item>
            <x-link href="https://tailwindcss.com/docs/plugins#forms" label="@tailwindcss/forms 0.4.x" target="_blank" underline="none"/>
        </x-docs::list.item>

        <x-docs::list.item>
            <x-link href="https://tailwindcss.com/docs/plugins#typography" label="@tailwindcss/typography 0.5.x" target="_blank" underline="none"/>
        </x-docs::list.item>
    </x-docs::list>

    {{-- Section --}}
    <x-docs::title id="installation" title="Installation" />

    <x-docs::text>
        <b>1.</b> Run the following command to add WireUI to your project:
    </x-docs::text>

    <x-docs::code.block language="bash">
        @verbatim
            composer require wireui/wireui
        @endverbatim
    </x-docs::code.block>

    <x-docs::text>
        <b>2.</b> Add the WireUI tag above Alpinejs script tag in your page layout:
    </x-docs::text>

    <x-docs::code.block language="html">
        @verbatim
            <html>
                <head>
                    ...
                    <wireui:scripts />
                    <script src=\"//unpkg.com/alpinejs\" defer></script>
                </head>
            </html>
        @endverbatim
    </x-docs::code.block>

    <x-docs::text>
        Alternatively, you can use the equivalent Blade directive:
    </x-docs::text>

    <x-docs::code.block language="html">
        @verbatim
            ...
            @wireUiScripts
            <script src=\"//unpkg.com/alpinejs\" defer></script>
            ...

            Sometimes you need to pass extra html attributes to script tag, like the nonce attribute
            @wireUiScripts(['nonce': 'csp-token'])
            @wireUiScripts(['nonce': 'csp-token', 'foo' => true])
        @endverbatim
    </x-docs::code.block>

    <x-docs::text>
        <b>3.</b> Add the following settings to your Tailwindcss config file,
        <x-docs::mark>tailwind.config.js</x-docs::mark>:
    </x-docs::text>

    <x-docs::code.block language="js">
        @verbatim
            module.exports = {
                ...
                presets: [
                    ...
                    require('./vendor/wireui/wireui/tailwind.config.js')
                ],
                content: [
                    ...
                    './vendor/wireui/wireui/resources/**/*.blade.php',
                    './vendor/wireui/wireui/ts/**/*.ts',
                    './vendor/wireui/wireui/src/View/**/*.php'
                ],
                ...
            }
        @endverbatim
    </x-docs::code.block>

    {{-- Section --}}
    <x-docs::title id="publishing" title="Publishing" />

    <x-docs::text>
        WireUI does not need any additional configuration, but you can publish the files and customize them to your
        preference.
    </x-docs::text>

    <x-docs::code.block language="bash">
        @verbatim
            php artisan vendor:publish --tag='wireui.config'
            php artisan vendor:publish --tag='wireui.resources'
            php artisan vendor:publish --tag='wireui.lang'
        @endverbatim
    </x-docs::code.block>
</x-docs-scope>
