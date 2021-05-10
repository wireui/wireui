<?php

namespace WireUi\Mixins\Stringable;

class UnlessMixin
{
    public function __invoke()
    {
        return function (bool $condition, callable $callback) {
            if (!$condition) {
                return $callback($this) ?: $this;
            }

            return $this;
        };
    }
}
