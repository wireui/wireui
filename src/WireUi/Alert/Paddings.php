<?php

namespace WireUi\WireUi\Alert;

use WireUi\Support\ComponentPack;

class Paddings extends ComponentPack
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
            'base' => 'pl-1 mt-2 ml-5',
        ];
    }
}
