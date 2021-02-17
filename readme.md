# WireUI

WireUi is a [Blade] with [Alpinejs] and [Livewire] component library, styled with [Tailwind]

#### Prerequisites

-   [Laravel 7+]
-   [Livewire 2+]
-   [SweetAlert2 10+]
-   [Tailwind]

#### Installation

-   Install composer package `composer require ph7jack/wireui`
-   Install **ts-loader** `yarn add ts-loader typescript --dev`
-   Import **Wire UI** scripts into your Webpack, ex: `webpack.mix.js`
    ```
    mix.ts('wireui/resources/ts/index.js', 'public/js/wireui.js')
    ```
-   Import wireui.js in your app layout, below Livewire and Alpine.js, ex: `resources/views/layouts/app.blade.php`
    ```
    <script src="{{ asset(mix('js/wireui.js')) }}"></script>
    ```
-   Add these paths in the tailwindcss purge option
    ```
    './vendor/ph7j4ck/wireui/resources/views/**/*.blade.php',
    './vendor/ph7j4ck/wireui/resources/ts/**/*.js',
    ```

#### Langs

-   En-US

#### Components

-   All heroicons outline and solid
-   Spinner loading
-   Message Error

#### Publish

You can publish assets, config and lang to customize
`php artisan vendor:publish --tag="wireui.config"`
`php artisan vendor:publish --tag="wireui.resources"`
`php artisan vendor:publish --tag="wireui.lang"`

## License

MIT
**Free Software, Hell Yeah!**

[livewire]: https://laravel-livewire.com/
[livewire 2+]: https://laravel-livewire.com/
[laravel 7+]: https://laravel.com/
[blade]: https://laravel.com/docs/8.x/blade
[sweetalert2 10+]: https://sweetalert2.github.io/
[tailwind]: https://tailwindcss.com/
