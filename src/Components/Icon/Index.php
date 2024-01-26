<?php

namespace WireUi\Components\Icon;

use WireUi\Heroicons;

class Index extends Heroicons\Icon
{
    protected function defaultVariant(): string
    {
        return config('wireui.icon.variant') ?? 'outline';
    }
}
