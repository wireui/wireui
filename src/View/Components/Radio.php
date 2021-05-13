<?php

namespace WireUi\View\Components;

class Radio extends Checkbox
{
    protected function getView(): string
    {
        return 'wireui::components.radio';
    }
}
