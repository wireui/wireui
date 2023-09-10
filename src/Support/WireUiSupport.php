<?php

namespace WireUi\Support;

use Illuminate\View\ComponentAttributeBag;
use WireUi\Support\{BladeDirectives, ComponentResolver};

class WireUiSupport
{
    public function components(): ComponentResolver
    {
        return new ComponentResolver();
    }

    public function directives(): BladeDirectives
    {
        return new BladeDirectives();
    }

    public function component(string $name): string
    {
        return (new static())->components()->resolve($name);
    }

    public function extractAttributes(mixed $property): ComponentAttributeBag
    {
        return check_slot($property) ? $property->attributes : new ComponentAttributeBag();
    }
}
