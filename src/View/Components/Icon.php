<?php

namespace WireUi\View\Components;

use WireUi\Heroicons;

class Icon extends Heroicons\Icon
{
    protected function defaultVariant(): string
    {
        /** @var string */
        return config('wireui.icons.variant');
    }
}
