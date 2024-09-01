<?php

namespace WireUi\Components\TextField;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupColor;
use WireUi\Traits\Components\HasSetupRounded;
use WireUi\Traits\Components\HasSetupWrapper;
use WireUi\View\WireUiComponent;

class Number extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupWrapper;

    protected array $props = [
        'icon' => 'minus',
        'right-icon' => 'plus',
    ];

    protected function blade(): View
    {
        return view('wireui-text-field::number');
    }
}
