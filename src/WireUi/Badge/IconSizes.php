<?php

namespace WireUi\WireUi\Toggle;

use WireUi\Support\ComponentPack;

class IconSizes extends ComponentPack
{
    protected function default(): mixed
    {
        return config('wireui.badge.icon-size') ?? 'sm';
    }

    public function all(): array
    {
        return [
            'sm' => 'w-3 h-3',
            'md' => 'w-4 h-4',
            'lg' => 'w-5 h-5',
        ];
    }
}
