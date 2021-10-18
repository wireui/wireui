<?php

namespace WireUi;

class WireUiComponentResolver
{
    public function resolve(string $originalComponentName): string
    {
        $components = config('wireui.components');

        return $components[$originalComponentName]['alias'];
    }
}
