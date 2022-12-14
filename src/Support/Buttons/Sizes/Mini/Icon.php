<?php

namespace WireUi\Support\Buttons\Sizes\Mini;

use WireUi\Support\Buttons\Sizes\SizePack;

class Icon extends SizePack
{
    public function default(): string
    {
        return $this->get(config('wireui.button.size'));
    }

    public function all(): array
    {
        return [
            '2xs' => 'w-2 h-2',
            'xs'  => 'w-3 h-3',
            'sm'  => 'w-3.5 h-3.5',
            'md'  => 'w-4 h-4',
            'lg'  => 'w-5 h-5',
            'xl'  => 'w-6 h-6',
            '2xl' => 'w-7 h-7',
        ];
    }
}
