<?php

namespace WireUi\WireUi\Dropdown;

use WireUi\Support\ComponentPack;

class Align extends ComponentPack
{
    protected function default(): string
    {
        return 'right';
    }

    public function all(): array
    {
        return [
            'right'     => 'origin-top-right right-0',
            'left'      => 'origin-top-left left-0',
            'top-right' => 'origin-top-right right-0 bottom-0',
            'top-left'  => 'origin-top-left left-0 bottom-0',
        ];
    }
}
