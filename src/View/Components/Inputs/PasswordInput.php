<?php

namespace WireUi\View\Components\Inputs;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use WireUi\Traits\Components\IsFormComponent;

class PasswordInput extends Component
{
    use IsFormComponent;

    public function blade(): View
    {
        return view('wireui::components.inputs.password');
    }
}
