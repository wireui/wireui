# WireUI

WireUi is a [Tall Stack] UI Components library

#### Installation

-   Install composer package `composer require ph7jack/wireui`
-   Import Wire UI assets in your app layout, below Livewire and Alpine.js, ex: `resources/views/layouts/app.blade.php`
    ```
    <head>
        ...
        <wireui:styles /> or @wireUiStyles
        ...
    </head>
    ...
    <wireui:scripts /> or @wireUiScripts
    ```

#### Langs

-   En-US

#### Components

-   All heroicons outline and solid
-   Spinner loading
-   Message Error
-   Notifications

#### Publish

You can publish assets, config and lang to customize

```
php artisan vendor:publish --tag="wireui.config"
php artisan vendor:publish --tag="wireui.resources"
php artisan vendor:publish --tag="wireui.lang"
```

## License

MIT
**Free Software, Hell Yeah!**

[livewire]: https://laravel-livewire.com
[livewire 2+]: https://laravel-livewire.com
[laravel 7+]: https://laravel.com
[blade]: https://laravel.com/docs/8.x/blade
[sweetalert2 10+]: https://sweetalert2.github.io
[tailwind]: https://tailwindcss.com
[tall stack]: https://tallstack.dev
