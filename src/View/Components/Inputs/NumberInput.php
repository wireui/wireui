<?php

namespace WireUi\View\Components\Inputs;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupForm;
use WireUi\View\Components\BaseComponent;

class NumberInput extends BaseComponent
{
    use HasSetupForm;

    public function __construct(
        public string $leftIcon = 'minus',
        public string $rightIcon = 'plus',
    ) {
    }

    protected function blade(): View
    {
        return view('wireui::components.inputs.number');
    }
}
