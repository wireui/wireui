<?php

namespace WireUi\View\Components\Input;

class PhoneInput extends BaseMaskable
{
    protected function getInputMask(): string
    {
        return "['(###) ###-####', '+# ### ###-####', '+## ## ####-####']";
    }
}
