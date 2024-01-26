<?php

namespace WireUi\Components\Dropdown\WireUi;

use WireUi\Support\ComponentPack;

class Height extends ComponentPack
{
    protected function default(): string
    {
        return '3xl';
    }

    public function all(): array
    {
        return [
            'sm'  => 'max-h-40',
            'md'  => 'max-h-44',
            'lg'  => 'max-h-48',
            'xl'  => 'max-h-52',
            '2xl' => 'max-h-56',
            '3xl' => 'max-h-60',
            '4xl' => 'max-h-64',
            '5xl' => 'max-h-72',
            '6xl' => 'max-h-80',
            '7xl' => 'max-h-96',
        ];
    }
}
