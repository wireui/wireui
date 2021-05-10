<?php

namespace WireUi\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Stringable;
use WireUi\Facades\WireUiDirectives;
use WireUi\Mixins\Stringable\UnlessMixin;
use WireUi\Support\WireUiTagCompiler;
use WireUi\View\Components\Button;
use WireUi\View\Components\Card;
use WireUi\View\Components\Dropdown;
use WireUi\View\Components\Dropdown\DropdownHeader;
use WireUi\View\Components\Dropdown\DropdownItem;
use WireUi\View\Components\Error;
use WireUi\View\Components\Icon;
use WireUi\View\Components\Input;
use WireUi\View\Components\Inputs\CurrencyInput;
use WireUi\View\Components\Inputs\MaskableInput;
use WireUi\View\Components\Inputs\PhoneInput;
use WireUi\View\Components\Label;
use WireUi\View\Components\NativeSelect;
use WireUi\View\Components\Notifications;
use WireUi\View\Components\TimePicker;

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
        Blade::component(Icon::class, 'icon');
        Blade::component(Input::class, 'input');
        Blade::component(MaskableInput::class, 'inputs.maskable');
        Blade::component(PhoneInput::class, 'inputs.phone');
        Blade::component(CurrencyInput::class, 'inputs.currency');
        Blade::component(Button::class, 'button');
        Blade::component(Dropdown::class, 'dropdown');
        Blade::component(DropdownItem::class, 'dropdown.item');
        Blade::component(DropdownHeader::class, 'dropdown.header');
        Blade::component(Notifications::class, 'notifications');
        Blade::component(TimePicker::class, 'time-picker');
        Blade::component(Card::class, 'card');
        Blade::component(Error::class, 'error');
        Blade::component(NativeSelect::class, 'native-select');
        Blade::component(Label::class, 'label');
    }

    protected function registerMixins()
    {
        Stringable::macro('unless', app(UnlessMixin::class)());
    }
}
