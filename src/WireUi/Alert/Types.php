<?php

namespace WireUi\WireUi\Alert;

use WireUi\Support\ComponentPack;

class Types extends ComponentPack
{
    protected function default(): mixed
    {
        return config('wireui.alert.type') ?? 'base';
    }

    public function all(): array
    {
        return [
            'base' => 'pl-1 mt-2 ml-5',
        ];
    }
}
