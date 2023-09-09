<?php

namespace WireUi\WireUi\Modal;

use WireUi\Support\ComponentPack;

class Types extends ComponentPack
{
    protected function default(): string
    {
        return 'base';
    }

    public function all(): array
    {
        return [
            'base' => [
                'z-index'        => 'z-50',
                'spacing'        => 'p-4',
                'soft-scrollbar' => false,
                'hide-scrollbar' => false,
            ],
            'soft' => [
                'z-index'        => 'z-50',
                'spacing'        => 'p-4',
                'soft-scrollbar' => true,
                'hide-scrollbar' => false,
            ],
            'hide' => [
                'z-index'        => 'z-50',
                'spacing'        => 'p-4',
                'soft-scrollbar' => false,
                'hide-scrollbar' => true,
            ],
        ];
    }
}
