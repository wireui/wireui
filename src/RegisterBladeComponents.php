<?php

namespace PH7JACK\WireUi;

use Illuminate\Support\Facades\Blade;
use PH7JACK\WireUi\Contracts\RegisterComponent;

class RegisterBladeComponents implements RegisterComponent
{
    public static function register(): void
    {
        $components = [
            'icons.calendar',
            'icons.chevron-left',
            'icons.chevron-right',
            'icons.spinner',
            'icon',
            'error',
        ];

        foreach ($components as $component) {
            Blade::component(
                WireUiServiceProvider::PACKAGE_NAME . "::components.{$component}",
                WireUiServiceProvider::PACKAGE_NAME . ".{$component}"
            );
        }
    }
}
