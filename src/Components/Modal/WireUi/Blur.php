<?php

namespace WireUi\Components\Modal\WireUi;

use WireUi\Support\ComponentPack;

class Blur extends ComponentPack
{
    protected function default(): string
    {
        return 'none';
    }

    public function all(): array
    {
        return [
            'none' => 'backdrop-blur-none',
            'sm'   => 'backdrop-blur-sm',
            'base' => 'backdrop-blur',
            'md'   => 'backdrop-blur-md',
            'lg'   => 'backdrop-blur-lg',
            'xl'   => 'backdrop-blur-xl',
            '2xl'  => 'backdrop-blur-2xl',
            '3xl'  => 'backdrop-blur-3xl',
        ];
    }
}
