<?php

namespace WireUi\WireUi\Avatar;

use WireUi\Support\ComponentPack;

class Borders extends ComponentPack
{
    /**
     * Get the default option.
     */
    protected function default(): string
    {
        return 'base';
    }

    /**
     * Get the available options.
     */
    public function all(): array
    {
        return [
            'base' => 'border',
        ];
    }
}
