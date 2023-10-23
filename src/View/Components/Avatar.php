<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded, HasSetupSize};

class Avatar extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupSize;

    protected array $packs = ['border', 'icon-size'];

    protected array $props = [
        'src'        => null,
        'icon'       => null,
        'label'      => null,
        'borderless' => false,
    ];

    public function blade(): View
    {
        return view('wireui::components.avatar');
    }
}
