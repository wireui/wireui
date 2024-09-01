<?php

namespace WireUi\Components\TimePicker;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupForm;
use WireUi\Traits\Components\HasSetupRounded;
use WireUi\View\WireUiComponent;

class Selector extends WireUiComponent
{
    use HasSetupForm;
    use HasSetupRounded;

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
