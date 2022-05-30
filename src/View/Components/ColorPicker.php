<?php

namespace WireUi\View\Components;

class ColorPicker extends FormComponent
{
    public function __construct(
        public $rightIcon = 'color-swatch'
    ) {
    }

    protected function getView(): string
    {
        return 'wireui::components.color-picker';
    }
}
