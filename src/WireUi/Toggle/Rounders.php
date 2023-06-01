<?php

namespace WireUi\WireUi\Toggle;

use WireUi\Support\ComponentPack;

class Rounders extends ComponentPack
{
    public function __toString(): string
    {
        return 'toggle rounded';
    }

    protected function default(): string
    {
        $rounded = config('wireui.toggle.rounded') ?? 'base';

        $this->checkAttribute($rounded);

        return $this->get($rounded);
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
