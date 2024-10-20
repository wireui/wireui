<?php

namespace WireUi;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;
use WireUi\Facades\WireUi;
use WireUi\Providers\BladeDirectives;
use WireUi\Providers\CustomMacros;
use WireUi\Support\ComponentResolver;
use WireUi\View\WireUiTagCompiler;

/**
 * @property Application $app
 */
class ServiceProvider extends Support\ServiceProvider
{
    public function register(): void
    {
        $this->registerViews();

        $this->registerConfig();

        $this->registerWireUI();

        $this->setupHeroiconsComponent();
    }

    public function boot(): void
    {
        CustomMacros::register();

        BladeDirectives::register();

        $this->registerTagCompiler();

        $this->registerBladeComponents();

        if (! $this->app->isProduction()) {
            $this->registerDevCommands();
        }
    }

    private function registerTagCompiler(): void
    {
        Blade::precompiler(static function (string $string): string {
            return app(WireUiTagCompiler::class)->compile($string);
        });
    }

    private function registerConfig(): void
    {
        $this->loadRoutesFrom($this->srcDir('routes.php'));

        $this->loadTranslationsFrom($this->srcDir('lang'), 'wireui');

        $this->mergeConfigFrom($this->srcDir('config.php'), 'wireui');

        $this->publishes(
            [$this->srcDir('lang') => $this->app->langPath('vendor/wireui')],
            'wireui.lang',
        );

        $this->publishes(
            [$this->srcDir('config.php') => $this->app->configPath('wireui.php')],
            'wireui.config',
        );
    }

    private function registerWireUI(): void
    {
        $this->app->singleton('WireUi', WireUi::class);

        $loader = AliasLoader::getInstance();

        $loader->alias('WireUi', WireUi::class);
    }

    private function registerViews(): void
    {
        $views = File::glob($this->srcDir('Components/*/views'));

        collect($views)->each(function (string $path) {
            $name = Str::kebab(basename(dirname($path)));

            $this->loadViewsFrom($path, "wireui-{$name}");
        });
    }

    private function setupHeroiconsComponent(): void
    {
        config()->set('wireui.heroicons.alias', 'heroicons');
    }

    private function srcDir(string $path): string
    {
        return __DIR__."/{$path}";
    }

    private function registerBladeComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, static function (BladeCompiler $blade): void {
            $resolver = new ComponentResolver;

            foreach (config('wireui.components') as $component) {
                $blade->component($component['class'], $resolver->addPrefix($component['alias']));
            }
        });
    }

    private function registerDevCommands(): void
    {
        $this->commands([
            Commands\WireUiGenerateIdeHelperCode::class,
        ]);
    }
}
