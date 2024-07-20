<?php

namespace WireUi\Components\Avatar;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\InteractsWithColor;
use WireUi\Traits\Components\InteractsWithRounded;
use WireUi\Traits\Components\InteractsWithSize;
use WireUi\View\WireUiComponent;

class Index extends WireUiComponent
{
    use InteractsWithColor;
    use InteractsWithRounded;
    use InteractsWithSize;

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
