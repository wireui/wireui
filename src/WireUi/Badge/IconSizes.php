<?php

namespace WireUi\WireUi\Badge;

use WireUi\Support\ComponentPack;

class IconSizes extends ComponentPack
{
    protected function default(): string
    {
        return 'sm';
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
