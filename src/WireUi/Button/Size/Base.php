<?php

namespace WireUi\WireUi\Button\Size;

use WireUi\Support\ComponentPack;

class Base extends ComponentPack
{
    protected function default(): string
    {
        return 'md';
    }

    public function all(): array
    {
        return [
            '2xs' => 'gap-x-0.5 text-2xs px-2 py-0.5',
            'xs'  => 'gap-x-1 text-xs px-2.5 py-1.5',
            'sm'  => 'gap-x-2 text-sm leading-4 px-3 py-2',
            'md'  => 'gap-x-2 text-sm px-4 py-2',
            'lg'  => 'gap-x-2 text-base px-4 py-2.5',
            'xl'  => 'gap-x-2 text-lg px-6 py-3',
            '2xl' => 'gap-x-3 text-xl px-7 py-4',
        ];
    }
}
