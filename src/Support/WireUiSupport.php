<?php

namespace WireUi\Support;

use Illuminate\Support\Collection;

class WireUiSupport
{
    /**
     * Get the component resolver.
     */
    public function components(): ComponentResolver
    {
        return new ComponentResolver();
    }

    /**
     * Get the blade directives.
     */
    public function directives(): BladeDirectives
    {
        return new BladeDirectives();
    }

    /**
     * Resolve the component alias.
     */
    public function component(string $name): string
    {
        return (new static())->components()->resolve($name);
    }

    /**
     * Get default components.
     */
    public function defaultComponents(): Collection
    {
        return (new static())->components()->defaultComponents();
    }
}
