<?php

namespace WireUi\Components\Notifications\WireUi;

use WireUi\Support\ComponentPack;

class Position extends ComponentPack
{
    protected function default(): string
    {
        return 'top-end';
    }

    public function all(): array
    {
        return [
            'top'          => 'sm:items-start sm:justify-center',
            'top_start'    => 'sm:items-start sm:justify-start',
            'top-end'      => 'sm:items-start sm:justify-end',
            'bottom'       => 'sm:items-end sm:justify-center',
            'bottom-start' => 'sm:items-end sm:justify-start',
            'bottom_end'   => 'sm:items-end sm:justify-end',
        ];
    }
}
