<?php

namespace WireUi\Components\Button;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\InteractsWithButton;
use WireUi\Traits\Components\InteractsWithColor;
use WireUi\Traits\Components\InteractsWithRounded;
use WireUi\Traits\Components\InteractsWithSize;
use WireUi\Traits\Components\InteractsWithSpinner;
use WireUi\Traits\Components\InteractsWithStateColor;
use WireUi\Traits\Components\InteractsWithVariant;
use WireUi\View\WireUiComponent;

class Mini extends WireUiComponent
{
    use InteractsWithButton;
    use InteractsWithColor;
    use InteractsWithRounded;
    use InteractsWithSize;
    use InteractsWithSpinner;
    use InteractsWithStateColor;
    use InteractsWithVariant;

    protected array $packs = ['icon-size'];

    protected array $props = [
        'icon' => null,
        'label' => null,
        'wire-load-enabled' => false,
        'use-validation-colors' => false,
    ];

    public function blade(): View
    {
        return view('wireui-button::mini');
    }
}
