<?php

namespace WireUi\Components\Dropdown\WireUi;

use WireUi\Support\ComponentPack;

class Width extends ComponentPack
{
    protected function default(): string
    {
        return 'lg';
    }

    public function all(): array
    {
        return [
            'sm'  => 'w-40',
            'md'  => 'w-44',
            'lg'  => 'w-48',
            'xl'  => 'w-52',
            '2xl' => 'w-56',
            '3xl' => 'w-60',
            '4xl' => 'w-64',
            '5xl' => 'w-72',
            '6xl' => 'w-80',
            '7xl' => 'w-96',
        ];
    }
}
