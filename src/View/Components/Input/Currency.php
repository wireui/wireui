<?php

namespace WireUi\View\Components\Input;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\Concerns\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded};
use WireUi\View\Components\WireUiComponent;

class Currency extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use IsFormComponent;

    protected array $packs = ['shadow'];

    public function __construct(
        public int $precision = 2,
        public string $decimal = '.',
        public string $thousands = ',',
        public bool $emitFormatted = false,
    ) {
    }

    protected function blade(): View
    {
        return view('wireui::components.input.currency');
    }
}
