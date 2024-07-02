<?php

namespace WireUi\Components\Avatar;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupColor;
use WireUi\Traits\Components\HasSetupRounded;
use WireUi\Traits\Components\HasSetupSize;
use WireUi\View\WireUiComponent;

class Index extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupSize;

    protected array $packs = ['border', 'icon-size'];

    protected array $props = [
        'alt' => null,
        'src' => null,
        'icon' => null,
        'label' => null,
        'borderless' => false,
    ];

    public function blade(): View
    {
        return view('wireui-avatar::index');
    }
}
