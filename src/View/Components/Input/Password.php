<?php

namespace WireUi\View\Components\Input;

use Illuminate\Contracts\View\View;

use WireUi\View\Components\WireUiComponent;

class Password extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupShadow;
    use IsFormComponent;

    public function blade(): View
    {
        return view('wireui::components.input.password');
    }
}
