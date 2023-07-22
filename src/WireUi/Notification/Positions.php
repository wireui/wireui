<?php

namespace WireUi\WireUi\Notification;

use WireUi\Support\ComponentPack;

class Positions extends ComponentPack
{
    /**
     * Get the default option.
     */
    protected function default(): string
    {
        return 'top-right';
    }

    /**
     * Get the available options.
     */
    public function all(): array
    {
        return [
            'top-left' => 'sm:items-start sm:justify-start',
            'top-center' => 'sm:items-start sm:justify-center',
            'top-right' => 'sm:items-start sm:justify-end',
            'bottom-left' => 'sm:items-end sm:justify-start',
            'bottom-center' => 'sm:items-end sm:justify-center',
            'bottom-right' => 'sm:items-end sm:justify-end',
        ];
    }
}
