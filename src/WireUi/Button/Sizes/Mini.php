<?php

namespace WireUi\WireUi\Button\Sizes;

use WireUi\Support\ComponentPack;

class Mini extends ComponentPack
{
    protected function default(): string
    {
        return 'md';
    }

    public function all(): array
    {
        return [
            '2xs' => 'text-2xs w-5 h-5',
            'xs'  => 'text-xs w-7 h-7',
            'sm'  => 'text-sm w-8 h-8',
            'md'  => 'text-sm w-9 h-9',
            'lg'  => 'text-base w-10 h-10',
            'xl'  => 'text-lg w-12 h-12',
            '2xl' => 'text-xl w-14 h-14',
        ];
    }
}
