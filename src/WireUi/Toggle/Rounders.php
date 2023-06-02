<?php

namespace WireUi\WireUi\Toggle;

use WireUi\Support\ComponentPack;

class Rounders extends ComponentPack
{
    protected function default(): string
    {
        return config('wireui.toggle.rounded') ?? 'base';
    }

    public function all(): array
    {
        return [
            'none' => 'toggle rounded none',
            'sm'   => 'toggle rounded sm',
            'base' => 'toggle rounded',
            'md'   => 'toggle rounded md',
            'lg'   => 'toggle rounded lg',
            'xl'   => 'toggle rounded xl',
            '2xl'  => 'toggle rounded 2xl',
            '3xl'  => 'toggle rounded 3xl',
            'full' => 'toggle rounded full',
        ];
    }
}
