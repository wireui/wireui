<?php

namespace WireUi\Facades;

use Illuminate\Support\Facades\Facade;
use WireUi\Support\{BladeDirectives, ComponentResolver, WireUiSupport};

/**
 * @method static ComponentResolver components()
 * @method static BladeDirectives directives()
 * @method static string component(string $name)
 * @method static string|null extractAttributes(mixed $property)
 */
class WireUi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return WireUiSupport::class;
    }
}
