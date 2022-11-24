<?php

namespace WireUi\Support\Buttons\Colors;

use Illuminate\Support\Arr;
use Stringable;

class Color implements Stringable
{
    public function __construct(
        public string|array $base = '',
        public string|array $hover = '',
        public string|array $focus = '',
    ) {
    }

    public function toString(): string
    {
        return Arr::toRecursiveCssClasses([
            $this->base,
            $this->hover,
            $this->focus,
        ]);
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
