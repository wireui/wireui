<?php

namespace WireUi\WireUi\Alert;

use WireUi\Support\ComponentPack;

class Paddings extends ComponentPack
{
    protected function default(): string
    {
        return 'base';
    }

    public function all(): array
    {
        return [
            'base' => 'pl-1 mt-2 ml-5',
        ];
    }
}
