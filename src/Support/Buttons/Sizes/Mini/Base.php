<?php

namespace WireUi\Support\Buttons\Sizes\Mini;

use WireUi\Support\Buttons\Sizes\SizePack;

class Base extends SizePack
{
    public function default(): string
    {
        return $this->get(config('wireui.button.size'));
    }

    public function all(): array
    {
        return [
            '2xs' => 'w-5 h-5',
            'xs'  => 'w-7 h-7',
            'sm'  => 'w-8 h-8',
            'md'  => 'w-9 h-9',
            'lg'  => 'w-10 h-10',
            'xl'  => 'w-12 h-12',
            '2xl' => 'w-14 h-14',
        ];
    }
}
