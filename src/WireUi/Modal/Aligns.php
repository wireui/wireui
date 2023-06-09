<?php

namespace WireUi\WireUi\Modal;

use WireUi\Support\ComponentPack;

class Aligns extends ComponentPack
{
    /**
     * Get the default option.
     */
    protected function default(): string
    {
        return 'start';
    }

    /**
     * Get the available options.
     */
    public function all(): array
    {
        return [
            'start'  => 'sm:items-start',
            'center' => 'sm:items-center',
            'end'    => 'sm:items-end',
        ];
    }
}
