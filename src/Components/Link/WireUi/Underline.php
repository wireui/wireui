<?php

namespace WireUi\Components\Link\WireUi;

use WireUi\Support\ComponentPack;

class Underline extends ComponentPack
{
    protected function default(): string
    {
        return 'hover';
    }

    public function all(): array
    {
        return [
            'always' => 'underline',
            'none'   => 'no-underline',
            'hover'  => 'no-underline hover:underline',
        ];
    }
}
