<?php

namespace WireUi\Components\Icon;

use WireUi\Enum\Packs;
use WireUi\Heroicons;

class Index extends Heroicons\Icon
{
    protected function defaultVariant(): string
    {
        return config('wireui.icon.variant') ?? Packs\Icon::OUTLINE;
    }
}
