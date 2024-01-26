<?php

namespace WireUi\Components\Alert\WireUi;

use WireUi\Support\ComponentPack;

class Padding extends ComponentPack
{
    protected function default(): string
    {
        return 'medium';
    }

    public function all(): array
    {
        return [
            'none'   => 'ml-2',
            'small'  => 'pl-1 mt-1 ml-3',
            'medium' => 'pl-1 mt-2 ml-5',
            'large'  => 'pl-1 mt-3 ml-7',
        ];
    }
}
