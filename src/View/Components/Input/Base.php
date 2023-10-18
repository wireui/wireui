<?php

namespace WireUi\View\Components\Input;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\Concerns\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded, HasSetupShadow};
use WireUi\View\Components\WireUiComponent;

class Base extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupShadow;
    use IsFormComponent;

    protected function blade(): View
    {
        return view('wireui::components.input.base');
    }
}
