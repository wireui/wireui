<?php

namespace WireUi\View\Directives;

use Illuminate\Support\Facades\Blade;

class WireUiBladeDirectives
{
    public static function register(): void
    {
        Blade::directive('confirmAction', function(string $expression) {
            return <<<EOT
                onclick="window.\$wireui.livewire.confirmAction($expression, '{{ \$_instance->id }}')"
            EOT;
        });
    }
}
