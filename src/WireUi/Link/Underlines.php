<?php

namespace WireUi\WireUi\Link;

use WireUi\Support\ComponentPack;

class Underlines extends ComponentPack
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
