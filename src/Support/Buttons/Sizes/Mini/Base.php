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
            '2xs' => 'text-2xs w-5 h-5',
            'xs'  => 'text-xs w-7 h-7',
            'sm'  => 'text-sm w-8 h-8',
            'md'  => 'text-sm w-9 h-9',
            'lg'  => 'text-base w-10 h-10',
            'xl'  => 'text-lg w-12 h-12',
            '2xl' => 'text-xl w-14 h-14',
        ];
    }
}
