<?php

namespace WireUi\View\Components\Input;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupWrapper;
use WireUi\View\Components\BaseComponent;

class Password extends BaseComponent
{
    use HasSetupWrapper;

    public function blade(): View
    {
        return view('wireui::components.input.password');
    }
}
