<?php

namespace WireUi\View\Components\Inputs;

class InputPhone extends BaseMaskable
{
    protected function getInputMask(): string
    {
        return "['(###) ###-####', '+# ### ###-####', '+## ## ####-####']";
    }
}
