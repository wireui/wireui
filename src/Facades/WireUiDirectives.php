<?php

namespace WireUi\Facades;

use Illuminate\Support\Facades\Facade;
use WireUi\Support\BladeDirectives;

/**
 * @method static string confirmAction(string $expression)
 * @method static string notify(string $expression)
 * @method static string styles(bool $absolute = true)
 * @method static string scripts(bool $absolute = true, array $attributes = [])
 * @method static string hooksScript()
 * @method static string|null getManifestVersion(string $file, ?string &$route = null)
 */
class WireUiDirectives extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return BladeDirectives::class;
    }
}
