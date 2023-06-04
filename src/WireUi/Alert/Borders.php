<?php

namespace WireUi\WireUi\Alert;

use WireUi\Support\ComponentPack;

class Borders extends ComponentPack
{
    protected function default(): mixed
    {
        return config('wireui.alert.border') ?? 'base';
    }

    public function all(): array
    {
        return [
            'base' => [
                'header' => 'border-b-2',
                'footer' => 'border-t-2',
            ],
        ];
    }
}
