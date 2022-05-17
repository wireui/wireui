<?php

namespace WireUi\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use WireUi\Facades\{WireUi, WireUiDirectives};
use WireUi\Support\WireUiTagCompiler;

class WireUiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerViews();
        $this->registerBladeDirectives();
        $this->registerBladeComponents();
        $this->registerTagCompiler();
    }

    public function register()
    {
        $this->app->singleton('WireUi', WireUi::class);
        $loader = AliasLoader::getInstance();
        $loader->alias('WireUi', WireUi::class);
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

        $this->loadViewsFrom("{$rootDir}/resources/views", 'wireui');
        $this->loadTranslationsFrom("{$rootDir}/src/lang", 'wireui');
        $this->mergeConfigFrom("{$rootDir}/src/config/wireui.php", 'wireui');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->publishes(
            ["{$rootDir}/src/config/wireui.php" => config_path('wireui.php')],
            'wireui.config'
        );

        $this->publishes(
            ["{$rootDir}/resources/views" => resource_path('views/vendor/wireui')],
            'wireui.resources'
        );

        if (is_dir(resource_path('lang'))) {
            $this->publishes(
                ["{$rootDir}/resources/lang" => resource_path('lang/vendor/wireui')],
                'wireui.lang'
            );
        }

        if (is_dir(base_path('lang'))) {
            $this->publishes(
                ["{$rootDir}/src/lang" => $this->app->langPath('vendor/wireui')],
                'wireui.lang'
            );
        }
    }

    protected function registerBladeDirectives(): void
    {
        Blade::directive('confirmAction', function (string $expression) {
            return WireUiDirectives::confirmAction($expression);
        });

        Blade::directive('notify', function (string $expression) {
            return WireUiDirectives::notify($expression);
        });

        Blade::directive('wireUiScripts', function () {
            return WireUiDirectives::scripts();
        });

        Blade::directive('wireUiStyles', function () {
            return WireUiDirectives::styles();
        });

        Blade::directive('boolean', function ($value) {
            return WireUiDirectives::boolean($value);
        });
    }

    protected function registerBladeComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            foreach (config('wireui.components') as $component) {
                $blade->component($component['class'], $component['alias']);
            }
        });
    }
}
