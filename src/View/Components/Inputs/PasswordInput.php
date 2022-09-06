<?php

namespace WireUi\View\Components\Inputs;

use WireUi\View\Components\Input;

class PasswordInput extends Input
{
    protected function getView(): string
    {
        return 'wireui::components.inputs.password';
    }
}
