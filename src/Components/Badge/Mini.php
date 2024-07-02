<?php

namespace WireUi\Components\Badge;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupColor;
use WireUi\Traits\Components\HasSetupRounded;
use WireUi\Traits\Components\HasSetupSize;
use WireUi\Traits\Components\HasSetupVariant;
use WireUi\View\WireUiComponent;

class Mini extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupSize;
    use HasSetupVariant;

    protected array $packs = ['icon-size'];

    protected array $props = [
        'icon' => null,
        'label' => null,
    ];

    public function blade(): View
    {
        return view('wireui-badge::mini');
    }
}
