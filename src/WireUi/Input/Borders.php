<?php

namespace WireUi\WireUi\Input;

use WireUi\Support\ComponentPack;

class Borders extends ComponentPack
{
    /**
     * Get the default option.
     */
    protected function default(): string
    {
        return '';
    }

    /**
     * Get the available options.
     */
    public function all(): array
    {
        return [
            //
        ];
    }
}
