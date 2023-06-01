<?php

namespace WireUi\WireUi\Checkbox;

use WireUi\Support\ComponentPack;

class Rounders extends ComponentPack
{
    public function __toString(): string
    {
        return 'checkbox rounded';
    }

    protected function default(): string
    {
        $rounded = config('wireui.checkbox.rounded') ?? 'base';

        $this->checkAttribute($rounded);

        return $this->get($rounded);
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
