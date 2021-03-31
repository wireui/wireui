<?php

namespace WireUi\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use WireUi\View\Components\Icon;
use WireUi\View\Directives\WireUiBladeDirectives;

class WireUiServiceProvider extends ServiceProvider
{
    public const PACKAGE_NAME = 'wireui';

    public function boot()
    {
        $rootDir = __DIR__ . '/../..';

        $this->loadViewsFrom("{$rootDir}/resources/views", self::PACKAGE_NAME);
        $this->loadTranslationsFrom("{$rootDir}/resources/lang", self::PACKAGE_NAME);
        $this->mergeConfigFrom("{$rootDir}/config/wireui.php", self::PACKAGE_NAME);
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->publishes([
            "{$rootDir}/config/wireui.php" => config_path('wireui.php'),
        ], self::PACKAGE_NAME . '.config');

        $this->publishes([
            "{$rootDir}/resources/views" => resource_path('views/vendor/' . self::PACKAGE_NAME),
        ], self::PACKAGE_NAME . '.resources');

        $this->publishes([
            "{$rootDir}/resources/lang" => resource_path('lang/vendor/' . self::PACKAGE_NAME),
        ], self::PACKAGE_NAME . '.lang');

        WireUiBladeDirectives::register();
        Blade::component(Icon::class, 'icon');
    }
}
