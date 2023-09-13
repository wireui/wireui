<?php

namespace WireUi\View\Components\Inputs;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use WireUi\Traits\Components\IsFormComponent;

class NumberInput extends Component
{
    use IsFormComponent;

    protected function blade(): View
    {
        return view('wireui::components.inputs.number');
    }
}
