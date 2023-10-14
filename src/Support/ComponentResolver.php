<?php

namespace WireUi\Support;

class ComponentResolver
{
    public function resolve(string $name): string
    {
        $components = config('wireui.components');

        return $components[$name]['alias'];
    }

    public function resolveClass(string $name): string
    {
        $components = config('wireui.components');

        return $components[$name]['class'];
    }

    public function resolveByAlias(string $name): string
    {
        $components = config('wireui.components');

        return collect($components)->search(fn (array $component) => $component['alias'] === $name);
    }
}
