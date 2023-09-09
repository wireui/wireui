<?php

namespace WireUi\Support;

<<<<<<<< HEAD:src/WireUi.php
use Illuminate\View\{ComponentAttributeBag, ComponentSlot};
use WireUi\Support\{BladeDirectives, ComponentResolver};

class WireUi
========
class WireUiSupport
>>>>>>>> 2.x:src/Support/WireUiSupport.php
{
    public function components(): ComponentResolver
    {
        return new ComponentResolver();
    }

    public function directives(): BladeDirectives
    {
        return new BladeDirectives();
    }

<<<<<<<< HEAD:src/WireUi.php
    public function extractAttributes(mixed $property): ComponentAttributeBag
    {
        return $property instanceof ComponentSlot
            ? $property->attributes
            : new ComponentAttributeBag();
========
    public function component(string $name): string
    {
        return (new static())->components()->resolve($name);
>>>>>>>> 2.x:src/Support/WireUiSupport.php
    }
}
