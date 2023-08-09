<?php

namespace WireUi\Support;

class ComponentResolver
{
    /**
     * Get the component alias from the name.
     */
    public function resolve(string $name): string
    {
        $components = config('wireui.components');

        return $components[$name]['alias'];
    }

    /**
     * Get the component class from the name.
     */
    public function resolveClass(string $name): string
    {
        $components = config('wireui.components');

        return $components[$name]['class'];
    }

    /**
     * Get the component alias from the name.
     */
    public function resolveByAlias(string $name): string
    {
        $components = config('wireui.components');

        return collect($components)->search(fn ($component) => $component['alias'] === $name);
    }
}
