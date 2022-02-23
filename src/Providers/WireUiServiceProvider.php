<?php

namespace WireUi\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\{ServiceProvider, Str, Stringable};
use Illuminate\View\Compilers\BladeCompiler;
use WireUi\Facades\{WireUiComponent, WireUiDirectives};
use WireUi\Mixins\Stringable\UnlessMixin;
use WireUi\Support\WireUiTagCompiler;

class WireUiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerViews();
        $this->registerBladeDirectives();
        $this->registerBladeComponents();
        $this->registerTagCompiler();
        $this->registerMixins();
    }

    public function register()
    {
        $this->app->singleton('WireUiComponent', WireUiComponent::class);
        $loader = AliasLoader::getInstance();
        $loader->alias('WireUiComponent', WireUiComponent::class);
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
        $this->mergeConfigFrom("{$rootDir}/config/wireui.php", 'wireui');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->publishes([
            "{$rootDir}/config/wireui.php" => config_path('wireui.php'),
        ], 'wireui.config');

        $this->publishes([
            "{$rootDir}/resources/views" => resource_path('views/vendor/wireui'),
        ], 'wireui.resources');

        if (is_dir(resource_path('lang'))) {
            $this->publishes([
                "{$rootDir}/resources/lang" => resource_path('lang/vendor/wireui'),
            ], 'wireui.lang');
        }

        if (is_dir(base_path('lang'))) {
            $this->publishes([
                "{$rootDir}/src/lang" => $this->app->langPath('vendor/wireui'),
            ], 'wireui.lang');
        }
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
            foreach (config('wireui.components') as $component) {
                $blade->component($component['class'], $component['alias']);
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
