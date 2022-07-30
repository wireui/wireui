<?php

namespace WireUi\View\Components\Inputs;

use WireUi\View\Components\Input;

class NumberInput extends Input
{
    public $except = ['type', 'icon', 'right-icon', 'rightIcon', 'prefix', 'suffix', 'prepend', 'append'];

    public function __construct(
        bool $borderless = false,
        bool $shadowless = false,
        ?string $label = null,
        ?string $hint = null,
        ?string $cornerHint = null,
    ) {
        parent::__construct($borderless, $shadowless, $label, $hint, $cornerHint);
    }

    protected function getView(): string
    {
        return 'wireui::components.inputs.number';
    }
}
