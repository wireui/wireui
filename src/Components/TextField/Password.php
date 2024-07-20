<?php

namespace WireUi\Components\TextField;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\InteractsWithWrapper;
use WireUi\View\WireUiComponent;

class Password extends WireUiComponent
{
    use InteractsWithWrapper;

    public function blade(): View
    {
        return view('wireui-text-field::password');
    }
}
