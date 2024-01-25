<?php

namespace WireUi\Components\Button;

use Illuminate\Contracts\View\View as BaseView;
use Illuminate\Support\Facades\View;
use WireUi\Traits\Components\{HasSetupButton, HasSetupColor, HasSetupRounded, HasSetupSize, HasSetupSpinner, HasSetupStateColor, HasSetupVariant};
use WireUi\View\WireUiComponent;

class Mini extends WireUiComponent
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
        'icon'                  => null,
        'label'                 => null,
        'wire-load-enabled'     => false,
        'use-validation-colors' => false,
    ];

    public function blade(): BaseView
    {
        return View::file(__DIR__ . '/views/mini.blade.php');
    }
}
