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
            // return LivewireBladeDirectives::js($expression);

            return <<<EOT
            <?php
                if (is_object({$expression}) || is_array({$expression})) {
                    echo "JSON.parse(atob('".base64_encode(json_encode({$expression}))."'))";
                } elseif (is_string({$expression})) {
                    echo "'".str_replace("'", "\'", {$expression})."'";
                } else {
                    echo json_encode({$expression});
                }
            ?>
            EOT;
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
