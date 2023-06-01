<?php

namespace WireUi\WireUi\Toggle;

use WireUi\Support\ComponentPack;

class IconSizes extends ComponentPack
{
    public function __toString(): string
    {
        return 'toggle icon size';
    }

    protected function default(): string
    {
        $icon = config('wireui.toggle.icon-size') ?? 'sm';

        $this->checkAttribute($icon);

        return $this->get($icon);
    }

    public function all(): array
    {
        return [
            'xs' => 'icon xs',
            'sm' => 'icon sm',
            'md' => 'icon md',
            'lg' => 'icon lg',
            'xl' => 'icon xl',
        ];
    }
}
