<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#troubleshooting" label="Troubleshooting" />

        <x-docs::summary.header href="#version-update" label="Version Update" />

        <x-docs::summary.header href="#using-https" label="WireUI not using https" />

        <x-docs::summary.header href="#tailwind-forms" label="Tailwind Forms" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="troubleshooting" title="Troubleshooting" />

    <x-docs::text>
        This page contains common issues encountered with WireUI and their solutions.
        <br>
        If you haven't found the problem you are trying to fix, review the
        <x-link href="https://github.com/wireui/wireui/issues" target="_blank">Issues</x-link>
        page at the WireUI GitHub repository.
        <br>
        In case your problem has not been discussed there, feel free to open a new Issue, informing as many details as
        possible.
    </x-docs::text>

    {{-- Section --}}
    <x-docs::title id="version-update" title="Version Update" />

    <x-docs::text>
        If you have recently updated WireUI and are facing issues, make sure to read the specific information for your
        version before proceeding in this section.
        <br><br>
        To stay informed about WireUI's latest news, follow the author
        <x-link href="https://twitter.com/ph7jack" target="_blank">@ph7jack</x-link> on Twitter.
    </x-docs::text>

    {{-- Section --}}
    <x-docs::title id="using-https" title="WireUI not using https" />

    <x-docs::text>
        If your assets (scripts, css files) are loaded with
        <x-docs::mark>http://</x-docs::mark> instead of
        <x-docs::mark>https://</x-docs::mark>, you may try the following steps:
    </x-docs::text>

    <x-docs::text>
        <br>
        <b>1.</b> Make sure the `APP_URL` inside your
        <x-docs::mark>.env</x-docs::mark> file is set with https prefix.
    </x-docs::text>

    <x-docs::code.block language="bash">
        @verbatim
            APP_URL=https://example.com
        @endverbatim
    </x-docs::code.block>

    <x-docs::text>
        <b>2.</b> Run the command below to clear Laravel's cache:
    </x-docs::text>

    <x-docs::code.block language="bash">
        @verbatim
            php artisan optimize:clear
        @endverbatim
    </x-docs::code.block>

    {{-- Section --}}
    <x-docs::title id="tailwind-forms" title="Tailwind Forms" />

    <x-docs::text>
        If you have encountered the error
        <x-docs::mark>TypeError: require(...) is not a function</x-docs::mark>,
        you must update your Tailwind-Forms to
        <x-docs::mark>"^0.3.0"</x-docs::mark>.
        This is often the case with Laravel Breeze installation.
    </x-docs::text>

    <x-docs::text.title title="Error:" />

    <x-docs::code.block language="bash" :line-numbers="false" no-copy>
        @verbatim
            ERROR in ./resources/css/app.css
            Module build failed (from ./node_modules/mini-css-extract-plugin/dist/loader.js):
            ModuleBuildError: Module build failed (from ./node_modules/postcss-loader/dist/cjs.js):
            TypeError: require(...) is not a function
            ...
            1 ERROR in child compilations (Use 'stats.children: true' resp. '--stats-children' for more details)
            webpack compiled with 2 errors
        @endverbatim
    </x-docs::code.block>

    <x-docs::text.title title="Solution:" />

    <x-docs::text>
        Modify your Tailwind-forms version and then, run <x-docs::mark>npm update</x-docs::mark> command.
    </x-docs::text>

    <x-docs::code.block language="js">
        @verbatim
            "devDependencies": {
                "@tailwindcss/forms": "^0.3.0",
                //..
            }
        @endverbatim
    </x-docs::code.block>
</x-docs-scope>
