<?php

namespace WireUi\View\Components\Inputs;

use WireUi\View\Components\Input;

class PasswordInput extends Input
{
    public function __construct(
        bool $borderless = false,
        bool $shadowless = false,
        ?string $label = null,
        ?string $hint = null,
        ?string $cornerHint = null,
        ?string $icon = null,
        ?string $prefix = null,
        ?string $prepend = null,
    ) {
        parent::__construct($borderless, $shadowless, $label, $hint, $cornerHint, $icon, null, $prefix, null, $prepend);
    }

    protected function getView(): string
    {
        return 'wireui::components.inputs.password';
    }
}
