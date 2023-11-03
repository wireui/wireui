<?php

namespace WireUi\View\Components;

use WireUi\Enum\Packs;
use WireUi\Heroicons;

class Icon extends Heroicons\Icon
{
    protected function defaultVariant(): string
    {
        return config('wireui.icon.variant') ?? Packs\Icon::OUTLINE;
    }
}
