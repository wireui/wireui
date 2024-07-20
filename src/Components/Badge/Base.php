<?php

namespace WireUi\Components\Badge;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\InteractsWithColor;
use WireUi\Traits\Components\InteractsWithRounded;
use WireUi\Traits\Components\InteractsWithSize;
use WireUi\Traits\Components\InteractsWithVariant;
use WireUi\View\WireUiComponent;

class Base extends WireUiComponent
{
    use InteractsWithColor;
    use InteractsWithRounded;
    use InteractsWithSize;
    use InteractsWithVariant;

    protected array $packs = ['icon-size'];

    protected array $props = [
        'full' => false,
        'icon' => null,
        'label' => null,
        'right-icon' => null,
    ];

    public function blade(): View
    {
        return view('wireui-badge::base');
    }
}
