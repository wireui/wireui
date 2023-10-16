<?php

namespace WireUi\WireUi\Modal;

use WireUi\Support\ComponentPack;

class Align extends ComponentPack
{
    protected function default(): string
    {
        return 'start';
    }

    public function all(): array
    {
        return [
            'start'  => 'sm:items-start',
            'center' => 'sm:items-center',
            'end'    => 'sm:items-end',
        ];
    }
}
