<?php

namespace WireUi\WireUi\Alert;

use WireUi\Support\ComponentPack;

class Borders extends ComponentPack
{
    protected function default(): string
    {
        return 'base';
    }

    public function all(): array
    {
        return [
            'base' => [
                'root'   => 'dark:border',
                'header' => 'border-b',
                'footer' => 'border-t',
            ],
        ];
    }
}
