<?php

namespace WireUi;

use Illuminate\Foundation\{AliasLoader, Application};
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use WireUi\Facades\WireUi;
use WireUi\Providers\{BladeDirectives, CustomMacros};
use WireUi\View\Compilers\WireUiTagCompiler;

/**
 * @property Application $app
 */
class WireUiServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerConfig();

        $this->registerWireUI();

        $this->setupHeroiconsComponent();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        CustomMacros::register();

        BladeDirectives::register();

        $this->registerTagCompiler();

        $this->registerBladeComponents();
    }

    /**
     * Register WireUi Tag Compiler.
     */
    private function registerTagCompiler(): void
    {
        Blade::precompiler(static function (string $string): string {
            return app(WireUiTagCompiler::class)->compile($string);
        });
    }

    /**
     * Register WireUi Config, Lang, Views and Routes.
     */
    private function registerConfig(): void
    {
        $this->loadRoutesFrom($this->srcDir('routes.php'));

        $this->loadTranslationsFrom($this->srcDir('lang'), 'wireui');

        $this->mergeConfigFrom($this->srcDir('config.php'), 'wireui');

        $this->loadViewsFrom($this->srcDir('resources/views'), 'wireui');

        $this->publishes(
            [$this->srcDir('lang') => $this->app->langPath('vendor/wireui')],
            'wireui.lang',
        );

        $this->publishes(
            [$this->srcDir('config.php') => $this->app->configPath('wireui.php')],
            'wireui.config',
        );

        $this->publishes(
            [$this->srcDir('resources/views') => $this->app->resourcePath('views/vendor/wireui')],
            'wireui.views',
        );
    }

    /**
     * Register WireUi Facade.
     */
    private function registerWireUI(): void
    {
        $this->app->singleton('WireUi', WireUi::class);

        $loader = AliasLoader::getInstance();

        $loader->alias('WireUi', WireUi::class);
    }

    /**
     * Setup Heroicons Component.
     */
    private function setupHeroiconsComponent(): void
    {
        config()->set('wireui.heroicons.alias', 'heroicons');
    }

    /**
     * Get the path to the src directory.
     */
    private function srcDir(string $path): string
    {
        return __DIR__ . "/{$path}";
    }

    /**
     * Register Blade Components.
     */
    private function registerBladeComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, static function (BladeCompiler $blade): void {
            foreach (config('wireui.components') as $component) {
                $blade->component($component['class'], $component['alias']);
            }
        });
    }
}
