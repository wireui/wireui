<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupButton, HasSetupColor, HasSetupSize};

class Link extends WireUiComponent
{
    use HasSetupButton;
    use HasSetupColor;
    use HasSetupSize;

    protected array $props = ['label'];

    protected array $packs = ['underline'];

    public function blade(): View
    {
        return view('wireui::components.link');
    }
}
