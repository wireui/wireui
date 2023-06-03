<?php

namespace WireUi\WireUi\Modal;

use WireUi\Support\ComponentPack;

class Aligns extends ComponentPack
{
    protected function default(): mixed
    {
        return config('wireui.modal.align') ?? 'start';
    }

    public function all(): array
    {
        return [
            'start'  => 'sm:items-start',
            'center' => 'sm:items-center',
            'end'    => 'sm:items-end',
        ];
    }
}
