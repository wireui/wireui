<?php

namespace WireUi\Components\Badge;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupColor;
use WireUi\Traits\Components\HasSetupRounded;
use WireUi\Traits\Components\HasSetupSize;
use WireUi\Traits\Components\HasSetupVariant;
use WireUi\View\WireUiComponent;

class Base extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupSize;
    use HasSetupVariant;

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
