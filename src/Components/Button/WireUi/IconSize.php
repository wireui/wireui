<?php

namespace WireUi\Components\Button\WireUi;

use WireUi\Support\ComponentPack;

class IconSize extends ComponentPack
{
    protected function default(): string
    {
        return 'md';
    }

    public function all(): array
    {
        return [
            '2xs' => 'w-2 h-2',
            'xs'  => 'w-3 h-3',
            'sm'  => 'w-3.5 h-3.5',
            'md'  => 'w-4 h-4',
            'lg'  => 'w-5 h-5',
            'xl'  => 'w-6 h-6',
            '2xl' => 'w-7 h-7',
        ];
    }
}
