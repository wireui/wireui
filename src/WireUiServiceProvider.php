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
    public function register(): void
    {
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

    private function registerWireUI(): void
    {
        $this->app->singleton('WireUi', WireUi::class);

        $loader = AliasLoader::getInstance();

        $loader->alias('WireUi', WireUi::class);
    }

    private function setupHeroiconsComponent(): void
    {
        config()->set('wireui.heroicons.alias', 'heroicons');
    }

    private function srcDir(string $path): string
    {
        return __DIR__ . "/{$path}";
    }

    protected function registerBladeDirectives(): self
    {
        Blade::directive('confirmAction', static function (string $expression): string {
            return WireUiDirectives::confirmAction($expression);
        });

        Blade::directive('notify', static function (string $expression): string {
            return WireUiDirectives::notify($expression);
        });

        Blade::directive('wireUiScripts', static function (?string $attributes = ''): string {
            if (!$attributes) {
                $attributes = '[]';
            }

            return "{!! WireUi::directives()->scripts(attributes: {$attributes}) !!}";
        });

        Blade::directive('wireUiStyles', static function (): string {
            return WireUiDirectives::styles();
        });

        // Blade::directive('boolean', static function ($value): string {
        //     return WireUiDirectives::boolean($value);
        // });

        Blade::directive('attributes', static function ($attributes): string {
            return "<?= new \WireUi\Support\ComponentAttributesBag({$attributes}) ?>";
        });

        // Blade::directive('toJs', static function ($expression): string {
        //     return LivewireBladeDirectives::js($expression);
        // });

        // Blade::directive('entangleable', static function ($value): string {
        //     return WireUiDirectives::entangleable($value);
        // });

        return $this;
    }

    private function registerBladeComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, static function (BladeCompiler $blade): void {
            foreach (config('wireui.components') as $component) {
                $blade->component($component['class'], $component['alias']);
            }
        });
    }

    protected function registerMacros(): self
    {
        Arr::macro('toRecursiveCssClasses', function ($classList): string {
            $classList = Arr::wrap($classList);
            $classes   = [];

            foreach ($classList as $class => $constraint) {
                if (is_numeric($class)) {
                    $classes[] = Arr::toCssClasses($constraint);
                } elseif ($constraint) {
                    $classes[] = $class;
                }
            }

            return implode(' ', $classes);
        });

        // ComponentAttributeBag::macro('wireModel', function () {
        //     $exists = count($this->whereStartsWith('wire:model')->getAttributes()) > 0;
        //
        //     if (!$exists) {
        //         return ['exists' => false];
        //     }
        //
        //     /** @var WireDirective $model */
        //     $model = $this->wire('model');
        //
        //     return [
        //         'exists'    => $exists,
        //         'name'      => $model->name(),
        //         'value'     => $this->wire('model')->value(),
        //         'modifiers' => [
        //             'live'     => $model->modifiers()->contains('live'),
        //             'blur'     => $model->modifiers()->contains('blur'),
        //             'debounce' => [
        //                 'exists' => $model->modifiers()->contains('debounce'),
        //                 'delay'  => (int) Str::of($model->modifiers()->get(1, '750'))->replace('ms', '')->toString(),
        //             ],
        //         ],
        //     ];
        // });

        ComponentAttributeBag::macro('attribute', function (string $name): ?Attribute {
            /** @var ComponentAttributeBag $this */
            $attributes = collect($this->whereStartsWith($name)->getAttributes());

            if ($attributes->isEmpty()) {
                return null;
            }

            return new Attribute(
                directive: $attributes->keys()->first(),
                expression: $attributes->first(),
            );
        });

        return $this;
    }
}
