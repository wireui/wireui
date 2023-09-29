<?php

namespace WireUi\View\Components\Inputs;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupForm;
use WireUi\View\Components\BaseComponent;

class CurrencyInput extends BaseComponent
{
    use HasSetupForm;

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
