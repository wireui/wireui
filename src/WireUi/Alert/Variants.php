<?php

namespace WireUi\WireUi\Alert;

use WireUi\Support\ComponentPack;
use WireUi\WireUi\Alert\Colors\{Flat, Outline, Solid};

class Variants extends ComponentPack
{
    /**
     * Get the default option.
     */
    protected function default(): string
    {
        return 'flat';
    }

    /**
     * Get the available options.
     */
    public function all(): array
    {
        return [
            'flat'    => Flat::class,
            'outline' => Outline::class,
            'solid'   => Solid::class,
        ];
    }
}
