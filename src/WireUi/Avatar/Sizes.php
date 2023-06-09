<?php

namespace WireUi\WireUi\Avatar;

use WireUi\Support\ComponentPack;

class Sizes extends ComponentPack
{
    /**
     * Get the default option.
     */
    protected function default(): string
    {
        return 'md';
    }

    /**
     * Get the available options.
     */
    public function all(): array
    {
        return [
            'xs'  => 'w-6 h-6',
            'sm'  => 'w-8 h-8',
            'md'  => 'w-10 h-10',
            'lg'  => 'w-12 h-12',
            'xl'  => 'w-14 h-14',
            '2xl' => 'w-18 h-18',
            '3xl' => 'w-24 h-24',
        ];
    }
}
