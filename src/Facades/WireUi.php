<?php

namespace WireUi\Facades;

use Illuminate\Support\Facades\Facade;
use WireUi\Support\{BladeDirectives, ComponentResolver};
use WireUi\WireUiSupport;

/**
 * @method static string component(string $name)
 * @method static ComponentResolver components()
 * @method static BladeDirectives directives()
 */
class WireUi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return WireUiSupport::class;
    }
}
