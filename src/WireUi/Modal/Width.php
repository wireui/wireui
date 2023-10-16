<?php

namespace WireUi\WireUi\Modal;

use WireUi\Support\ComponentPack;

class Width extends ComponentPack
{
    protected function default(): string
    {
        return '2xl';
    }

    public function all(): array
    {
        return [
            'sm'  => 'sm:max-w-sm',
            'md'  => 'sm:max-w-md',
            'lg'  => 'sm:max-w-lg',
            'xl'  => 'sm:max-w-xl',
            '2xl' => 'sm:max-w-2xl',
            '3xl' => 'sm:max-w-3xl',
            '4xl' => 'sm:max-w-4xl',
            '5xl' => 'sm:max-w-5xl',
            '6xl' => 'sm:max-w-6xl',
            '7xl' => 'sm:max-w-7xl',
        ];
    }
}
