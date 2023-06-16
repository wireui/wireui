<?php

namespace WireUi\WireUi\Card;

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
            'base' => 'px-2 py-5 md:px-4',
        ];
    }
}
