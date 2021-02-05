<?php

namespace PH7JACK\WireUi;

use Illuminate\Support\Facades\Blade;
use PH7JACK\WireUi\Contracts\RegisterComponent;

class WireUiBladeDirectives implements RegisterComponent
{
    public static function register(): void
    {
        Blade::directive('wireUiAssets', function () {
            return <<<'HTML'
                <script>

                </script>
            HTML;
        });
    }
}
