<?php

namespace WireUi\View\Components\Inputs;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use WireUi\Traits\Components\IsFormComponent;

class CurrencyInput extends Component
{
    use IsFormComponent;

    public function __construct(
        public string $thousands = ',',
        public string $decimal = '.',
        public int $precision = 2,
        public bool $emitFormatted = false,
    ) {
    }

    protected function blade(): View
    {
        return view('wireui::components.inputs.currency');
    }
}
