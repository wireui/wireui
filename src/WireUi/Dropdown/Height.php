<?php

namespace WireUi\WireUi\Dropdown;

use WireUi\Support\ComponentPack;

class Height extends ComponentPack
{
    protected function default(): string
    {
        return 'sm';
    }

    public function all(): array
    {
        return [
            'sm' => 'max-h-60',
        ];
    }
}
