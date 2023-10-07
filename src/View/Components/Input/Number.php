<?php

namespace WireUi\View\Components\Input;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupIcon, HasSetupWrapper};
use WireUi\View\Components\WireUiComponent;

class Number extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupIcon;
    use HasSetupRounded;
    use HasSetupShadow;
    use IsFormComponent;

    protected function rendered(): void
    {
        $this->icon ??= 'minus';

        $this->rightIcon ??= 'plus';
    }

    protected function blade(): View
    {
        return view('wireui::components.input.number');
    }
}
