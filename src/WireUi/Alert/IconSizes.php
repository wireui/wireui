<?php

namespace WireUi\WireUi\Alert;

use WireUi\Support\ComponentPack;

class IconSizes extends ComponentPack
{
    protected function default(): mixed
    {
        return config('wireui.alert.icon-size') ?? 'base';
    }

    public function all(): array
    {
        return [
            'base' => 'w-5 h-5 mr-3 shrink-0',
        ];
    }
}
