<?php

namespace WireUi\Support\Checkbox;

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
            'base' => 'rounded',
            'full' => 'rounded-full',
        ];
    }
}
