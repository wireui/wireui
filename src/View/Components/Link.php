<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupButton, HasSetupColor, HasSetupSize};
use WireUi\View\WireUiComponent;

class Link extends WireUiComponent
{
    use HasSetupButton;
    use HasSetupColor;
    use HasSetupSize;

    protected array $packs = ['underline'];

    protected array $props = [
        'label' => null,
    ];

    public function blade(): View
    {
        return view('wireui::components.link');
    }
}
