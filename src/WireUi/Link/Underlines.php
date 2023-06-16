<?php

namespace WireUi\WireUi\Link;

use WireUi\Support\ComponentPack;

class Underlines extends ComponentPack
{
    /**
     * Get the default option.
     */
    protected function default(): string
    {
        return 'hover';
    }

    /**
     * Get the available options.
     */
    public function all(): array
    {
        return [
            'always' => 'underline',
            'none'   => 'no-underline',
            'hover'  => 'no-underline hover:underline',
        ];
    }
}
