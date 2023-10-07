<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;

class Input extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupShadow;
    use IsFormComponent;

    protected function blade(): View
    {
        return view('wireui::components.input');
    }
}
