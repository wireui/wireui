<?php

namespace WireUi\WireUi\Avatar;

use WireUi\Support\ComponentPack;

class Border extends ComponentPack
{
    protected function default(): string
    {
        return 'base';
    }

    public function all(): array
    {
        return [
            'base' => 'border',
        ];
    }
}
