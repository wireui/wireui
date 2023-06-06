<?php

namespace WireUi\WireUi\Radio;

use WireUi\Support\ComponentPack;

class Rounders extends ComponentPack
{
    protected function default(): mixed
    {
        return config('wireui.radio.rounded') ?? 'full';
    }

    public function all(): array
    {
        return [
            'none' => 'rounded-none',
            'sm'   => 'rounded-sm',
            'base' => 'rounded',
            'md'   => 'rounded-md',
            'lg'   => 'rounded-lg',
            'xl'   => 'rounded-xl',
            '2xl'  => 'rounded-2xl',
            '3xl'  => 'rounded-3xl',
            'full' => 'rounded-full',
        ];
    }
}
