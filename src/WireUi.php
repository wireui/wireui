<?php

namespace WireUi;

use Illuminate\View\{ComponentAttributeBag, ComponentSlot};
use WireUi\Support\{BladeDirectives, ComponentResolver};

class WireUi
{
    public function component(string $name): string
    {
        return (new static())->components()->resolve($name);
    }

    public function components(): ComponentResolver
    {
        return new ComponentResolver();
    }

    public function directives(): BladeDirectives
    {
        return new BladeDirectives();
    }

    public function extractAttributes(mixed $property): ComponentAttributeBag
    {
        return $property instanceof ComponentSlot
            ? $property->attributes
            : new ComponentAttributeBag();
    }
}
