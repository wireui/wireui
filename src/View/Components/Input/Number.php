<?php

namespace WireUi\View\Components\Input;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupIcon, HasSetupWrapper};
use WireUi\View\Components\BaseComponent;

class Number extends BaseComponent
{
    use HasSetupIcon;
    use HasSetupWrapper;

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
