<?php

namespace WireUi\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use WireUi\Support\BladeDirectives;
use WireUi\Support\ComponentResolver;
use WireUi\Support\WireUiSupport;

/**
 * @method static ComponentResolver components()
 * @method static BladeDirectives directives()
 * @method static string component(string $name)
 * @method static Collection defaultComponents()
 */
class WireUi extends Facade
{
    /**
     * Get Facade Accessor.
     */
    protected static function getFacadeAccessor(): string
    {
        return WireUiSupport::class;
    }
}
