<?php

namespace WireUi\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::component(Components\Icon::class, 'icon');
        Blade::component(Components\Input::class, 'input');
        Blade::component(Components\Textarea::class, 'textarea');
        Blade::component(Components\Label::class, 'label');
        Blade::component(Components\Error::class, 'error');
        Blade::component(Components\Errors::class, 'errors');
        Blade::component(Components\Inputs\MaskableInput::class, 'inputs.maskable');
        Blade::component(Components\Inputs\PhoneInput::class, 'inputs.phone');
        Blade::component(Components\Inputs\CurrencyInput::class, 'inputs.currency');
        Blade::component(Components\Button::class, 'button');
        Blade::component(Components\Dropdown::class, 'dropdown');
        Blade::component(Components\Dropdown\DropdownItem::class, 'dropdown.item');
        Blade::component(Components\Dropdown\DropdownHeader::class, 'dropdown.header');
        Blade::component(Components\Notifications::class, 'notifications');
        Blade::component(Components\DatetimePicker::class, 'datetime-picker');
        Blade::component(Components\TimePicker::class, 'time-picker');
        Blade::component(Components\Card::class, 'card');
        Blade::component(Components\NativeSelect::class, 'native-select');
        Blade::component(Components\Select::class, 'select');
        Blade::component(Components\Select\Option::class, 'select.option');
        Blade::component(Components\Select\UserOption::class, 'select.user-option');
        Blade::component(Components\Toggle::class, 'toggle');
        Blade::component(Components\Checkbox::class, 'checkbox');
        Blade::component(Components\Radio::class, 'radio');
        Blade::component(Components\Modal::class, 'modal');
        Blade::component(Components\ModalCard::class, 'modal.card');
        Blade::component(Components\Dialog::class, 'dialog');
    }

    protected function registerMixins()
    {
        if (!Stringable::hasMacro('unless')) {
            Stringable::macro('unless', app(UnlessMixin::class)());
        }
    }
}
