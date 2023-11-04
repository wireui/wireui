<?php

namespace WireUi\View\Components\Input;

class Phone extends Maskable
{
    protected function getInputMask(): array
    {
        return ['(###) ###-####', '+# ### ###-####', '+## ## ####-####'];
    }
}
