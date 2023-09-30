<?php

namespace WireUi\View\Components\Input;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupWrapper;
use WireUi\View\Components\BaseComponent;

class Number extends BaseComponent
{
    use HasSetupWrapper;

    protected function blade(): View
    {
        return view('wireui::components.input.number');
    }
}
