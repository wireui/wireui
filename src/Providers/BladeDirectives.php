<?php

namespace WireUi\Providers;

use Illuminate\Support\Facades\Blade;
use Livewire\LivewireBladeDirectives;
use WireUi\Facades\WireUiDirectives;

class BladeDirectives
{
    /**
     * Register the Blade Directives.
     */
    public static function register(): void
    {
        Blade::directive('toJs', static function ($expression): string {
            return LivewireBladeDirectives::js($expression);
        });

        Blade::directive('boolean', static function ($value): string {
            return WireUiDirectives::boolean($value);
        });

        Blade::directive('entangleable', static function ($value): string {
            return WireUiDirectives::entangleable($value);
        });

        Blade::directive('notify', static function (string $expression): string {
            return WireUiDirectives::notify($expression);
        });

        Blade::directive('confirmAction', static function (string $expression): string {
            return WireUiDirectives::confirmAction($expression);
        });

        Blade::directive('wireUiStyles', static function (): string {
            return WireUiDirectives::styles();
        });

        Blade::directive('wireUiScripts', static function (?string $attributes = ''): string {
            if (!$attributes) {
                $attributes = '[]';
            }

            return "{!! WireUi::directives()->scripts(attributes: {$attributes}) !!}";
        });
    }
}
