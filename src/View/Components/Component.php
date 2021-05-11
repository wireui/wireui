<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use Illuminate\View;

abstract class Component extends View\Component
{
    protected function classes(array $classList): string
    {
        $classList = Arr::wrap($classList);
        $classes   = [];

        foreach ($classList as $class => $constraint) {
            if (is_numeric($class)) {
                $classes[] = $constraint;
            } elseif ($constraint) {
                $classes[] = $class;
            }
        }

        return implode(' ', $classes);
    }
}
