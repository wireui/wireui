<?php

namespace WireUi\View\Components\Input;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\Concerns\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded};
use WireUi\View\Components\WireUiComponent;

class Number extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use IsFormComponent;

    protected array $packs = ['shadow'];

    protected array $props = ['icon' => 'minus', 'rightIcon' => 'plus'];

    protected function blade(): View
    {
        return view('wireui::components.input.number');
    }
}
