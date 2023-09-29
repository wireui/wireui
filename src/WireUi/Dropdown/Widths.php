<?php

namespace WireUi\WireUi\Dropdown;

use WireUi\Support\ComponentPack;

class Widths extends ComponentPack
{
    protected function default(): string
    {
        return 'sm';
    }

    public function all(): array
    {
        return [
            'sm' => 'w-48',
        ];
    }
}
