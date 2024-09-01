<?php

namespace WireUi\Components\TextField;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\InteractsWithColor;
use WireUi\Traits\Components\InteractsWithRounded;
use WireUi\Traits\Components\InteractsWithWrapper;
use WireUi\View\WireUiComponent;

class Number extends WireUiComponent
{
    use InteractsWithColor;
    use InteractsWithRounded;
    use InteractsWithWrapper;

    protected array $props = [
        'icon' => 'minus',
        'right-icon' => 'plus',
    ];

    protected function blade(): View
    {
        return view('wireui-text-field::number');
    }
}
