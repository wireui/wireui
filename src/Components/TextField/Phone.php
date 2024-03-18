<?php

namespace WireUi\Components\TextField;

class Phone extends Maskable
{
    protected function getInputMask(): array
    {
        return ['(###) ###-####', '+# ### ###-####', '+## ## ####-####'];
    }
}
