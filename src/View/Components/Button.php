<?php

namespace WireUi\View\Components;

class Button extends BaseButton
{
    protected function getOutlineColors(): array
    {
        return config('wireui.classes.button.outlineColors');
    }

    protected function getFlatColors(): array
    {
        return config('wireui.classes.button.flatColors');
    }

    protected function getDefaultColors(): array
    {
        return config('wireui.classes.button.defaultColors');
    }

    protected function getSizes(): array
    {
        return config('wireui.sizes.button');
    }
}
