<?php

namespace WireUi\Components\Avatar\WireUi;

use WireUi\Support\ComponentPack;

class Size extends ComponentPack
{
    protected function default(): string
    {
        return 'md';
    }

    public function all(): array
    {
        return [
            '2xs' => 'w-6 h-6',
            'xs'  => 'w-7 h-7',
            'sm'  => 'w-8 h-8',
            'md'  => 'w-10 h-10',
            'lg'  => 'w-12 h-12',
            'xl'  => 'w-14 h-14',
            '2xl' => 'w-16 h-16',
        ];
    }
}
