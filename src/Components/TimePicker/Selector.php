<?php

namespace WireUi\Components\TimePicker;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupRounded;
use WireUi\Traits\Components\IsFormComponent;
use WireUi\View\WireUiComponent;

class Selector extends WireUiComponent
{
    use HasSetupRounded;
    use IsFormComponent;

    protected array $packs = ['shadow'];

    protected array $props = [
        'borderless' => false,
        'shadowless' => false,
        'military-time' => false,
        'without-seconds' => false,
    ];

    protected function blade(): View
    {
        return view('wireui-time-picker::selector');
    }
}
