<?php

namespace WireUi\Support\Checkbox;

use WireUi\Support\ComponentPack;

class Sizes extends ComponentPack
{
    public function __toString(): string
    {
        return 'checkbox size';
    }

    protected function default(): string
    {
        $size = config('wireui.checkbox.size') ?? 'sm';

        $this->checkAttribute($size);

        return $this->get($size);
    }

    public function all(): array
    {
        return [
            'xs' => 'w-3 h-3',
            'sm' => 'w-4 h-4',
            'md' => 'w-5 h-5',
            'lg' => 'w-6 h-6',
            'xl' => 'w-7 h-7',
        ];
    }
}
