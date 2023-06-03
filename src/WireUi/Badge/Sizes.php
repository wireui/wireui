<?php

namespace WireUi\WireUi\Checkbox;

use WireUi\Support\ComponentPack;

class Sizes extends ComponentPack
{
    protected function default(): mixed
    {
        return config('wireui.badge.size') ?? 'sm';
    }

    public function all(): array
    {
        return [
            'sm' => 'gap-x-1 text-xs font-semibold px-2.5 py-0.5',
            'md' => 'gap-x-1 text-sm font-semibold px-2.5 py-0.5',
            'lg' => 'gap-x-1 text-base font-semibold px-2.5 py-0.5',
        ];
    }
}
