<?php

namespace WireUi\Providers;

use Illuminate\Support\Facades\Blade;
use WireUi\View\BladeDirectives as Directives;

class BladeDirectives
{
    public static function register(): void
    {
        Blade::directive('toJs', static function ($expression): string {
            return Directives::toJs($expression);
        });

        // Blade::directive('boolean', static function ($value): string {
        //     return Directives::boolean($value);
        // });
        //
        // Blade::directive('entangleable', static function ($value): string {
        //     return Directives::entangleable($value);
        // });

        Blade::directive('notify', static function (string $expression): string {
            return Directives::notify($expression);
        });

        Blade::directive('confirmAction', static function (string $expression): string {
            return Directives::confirmAction($expression);
        });

        Blade::directive('wireUiStyles', static function (): string {
            return Directives::styles();
        });

        Blade::directive('attributes', static function ($attributes): string {
            return "<?= new \WireUi\View\ComponentAttributesBag({$attributes}) ?>";
        });

        Blade::directive('wireUiScripts', static function (?string $attributes = ''): string {
            if (!$attributes) {
                $attributes = '[]';
            }

            return "{!! WireUi::directives()->scripts(attributes: {$attributes}) !!}";
        });
    }
}
