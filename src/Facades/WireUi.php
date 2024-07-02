<?php

namespace WireUi\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\View\ComponentAttributeBag;
use Livewire\Component;
use WireUi\Support\BladeDirectives;
use WireUi\Support\ComponentResolver;
use WireUi\Support\WireUiSupport;

/**
 * @method static ComponentResolver components()
 * @method static BladeDirectives directives()
 * @method static string component(string $name)
 * @method static ComponentAttributeBag extractAttributes(mixed $property)
 * @method static string alpine(string $component, array $data = [])
 * @method static string toJs(array $data = [])
 * @method static array wireModel(?Component $component, ComponentAttributeBag $attributes)
 */
class WireUi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return WireUiSupport::class;
    }
}
