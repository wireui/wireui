<?php

namespace WireUi\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\Support\{ServiceProvider, Stringable};
use WireUi\Facades\WireUiDirectives;
use WireUi\Mixins\Stringable\UnlessMixin;
use WireUi\Support\WireUiTagCompiler;
use WireUi\View\Components;

class WireUiServiceProvider extends ServiceProvider
{
    public const PACKAGE_NAME = 'wireui';

    public function boot()
    {
        $this->registerViews();
        $this->registerBladeDirectives();
        $this->registerBladeComponents();
        $this->registerTagCompiler();
        $this->registerMixins();
    }

    protected function registerTagCompiler()
    {
        if (method_exists($this->app['blade.compiler'], 'precompiler')) {
            $this->app['blade.compiler']->precompiler(function ($string) {
                return app(WireUiTagCompiler::class)->compile($string);
            });
        }
    }

    protected function registerViews(): void
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
    }

    protected function registerBladeDirectives(): void
    {
        Blade::directive('confirmAction', fn (string $expression) => WireUiDirectives::confirmAction($expression));
        Blade::directive('notify', fn (string $expression) => WireUiDirectives::notify($expression));
        Blade::directive('wireUiScripts', fn () => WireUiDirectives::scripts());
        Blade::directive('wireUiStyles', fn () => WireUiDirectives::styles());
        Blade::directive('boolean', fn ($value) => WireUiDirectives::boolean($value));
    }

    protected function registerBladeComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            foreach (config('wireui.components') as $alias => $component) {
                $blade->component($component, $alias);
            }
        });
    }

    protected function registerMixins()
    {
        if (!Stringable::hasMacro('unless')) {
            Stringable::macro('unless', app(UnlessMixin::class)());
        }
    }
}
