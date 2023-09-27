<?php

namespace WireUi\WireUi\Alert;

use WireUi\Support\ComponentPack;

class Rounders extends ComponentPack
{
    protected function default(): string
    {
        return 'lg';
    }

    public function all(): array
    {
        return [
            'none' => 'rounded-none',
            'sm'   => 'rounded-sm',
            'base' => 'rounded',
            'md'   => 'rounded-md',
            'lg'   => 'rounded-lg',
            'xl'   => 'rounded-xl',
            '2xl'  => 'rounded-2xl',
            'full' => 'rounded-3xl',
        ];
    }
}
