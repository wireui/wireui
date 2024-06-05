<?php

namespace WireUi\Support;

use Illuminate\Support\Str;

class ComponentResolver
{
    public function resolve(string $name): string
    {
        $components = config('wireui.components');

        return $this->addPrefix($components[$name]['alias']);
    }

    public function resolveClass(string $name): string
    {
        $components = config('wireui.components');

        return $components[$this->removePrefix($name)]['class'];
    }

    public function resolveByAlias(string $name): string
    {
        $components = config('wireui.components');

        return collect($components)->search(
            fn (array $component) => $component['alias'] === $this->removePrefix($name),
        );
    }

    public function addPrefix(string $name): string
    {
        $prefix = config('wireui.prefix');

        return blank($prefix) ? $name : Str::start($name, $prefix);
    }

    public function removePrefix(string $name): string
    {
        $prefix = config('wireui.prefix');

        return blank($prefix) ? $name : Str::after($name, $prefix);
    }
}
