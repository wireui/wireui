<?php

namespace WireUi\WireUi\Alert;

use WireUi\Support\ComponentPack;

class Shadows extends ComponentPack
{
    protected function default(): string
    {
        return 'md';
    }

    public function all(): array
    {
        return [
            'none'  => 'shadow-none',
            'sm'    => 'shadow-sm',
            'base'  => 'shadow',
            'md'    => 'shadow-md',
            'lg'    => 'shadow-lg',
            'xl'    => 'shadow-xl',
            '2xl'   => 'shadow-2xl',
            'inner' => 'shadow-inner',
        ];
    }
}
