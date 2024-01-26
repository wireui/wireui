<?php

namespace WireUi\Components\Avatar\WireUi;

use WireUi\Support\ComponentPack;

class Border extends ComponentPack
{
    protected function default(): string
    {
        return 'thin';
    }

    public function all(): array
    {
        return [
            'none'  => 'border-0',
            'thin'  => 'border',
            'base'  => 'border-2',
            'thick' => 'border-4',
        ];
    }
}
