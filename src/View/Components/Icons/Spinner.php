<?php

namespace WireUi\View\Components\Icons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Spinner extends Component
{
    public function render(): View
    {
        return view('wireui::components.icons.spinner');
    }
}
