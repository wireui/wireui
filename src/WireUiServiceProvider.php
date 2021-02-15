<?php

namespace PH7JACK\WireUi;

use Illuminate\Support\ServiceProvider;

class WireUiServiceProvider extends ServiceProvider
{
    public const PACKAGE_NAME = 'wireui';

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', self::PACKAGE_NAME);
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', self::PACKAGE_NAME);
        $this->mergeConfigFrom(__DIR__ . '/config/wireui.php', self::PACKAGE_NAME);

        $this->publishes([
            __DIR__ . '/config/wireui.php' => config_path('wireui.php'),
        ], self::PACKAGE_NAME . '.config');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/' . self::PACKAGE_NAME),
        ], self::PACKAGE_NAME . '.resources');

        $this->publishes([
            __DIR__ . '/resources/lang' => resource_path('lang/vendor/' . self::PACKAGE_NAME),
        ], self::PACKAGE_NAME . '.lang');
    }

    public function register()
    {
    }
}
