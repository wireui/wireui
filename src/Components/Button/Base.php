<?php

namespace WireUi\Components\Button;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupButton;
use WireUi\Traits\Components\HasSetupColor;
use WireUi\Traits\Components\HasSetupRounded;
use WireUi\Traits\Components\HasSetupSize;
use WireUi\Traits\Components\HasSetupSpinner;
use WireUi\Traits\Components\HasSetupStateColor;
use WireUi\Traits\Components\HasSetupVariant;
use WireUi\View\WireUiComponent;

class Base extends WireUiComponent
{
    use HasSetupButton;
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupSize;
    use HasSetupSpinner;
    use HasSetupStateColor;
    use HasSetupVariant;

    protected array $packs = ['icon-size'];

    protected array $props = [
        'full' => false,
        'icon' => null,
        'label' => null,
        'right-icon' => null,
        'wire-load-enabled' => false,
        'use-validation-colors' => false,
    ];

    public function blade(): View
    {
        return view('wireui-button::base');
    }
}
