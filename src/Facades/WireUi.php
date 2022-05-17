<?php

namespace WireUi\Facades;

use Illuminate\Support\Facades\Facade;
use WireUi\Support\{BladeDirectives, ComponentResolver};

/**
 * @method static string component(string $name)
 * @method static ComponentResolver components()
 * @method static BladeDirectives directives()
 */
class WireUi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \WireUi\Wireui::class;
    }
}
