<?php

namespace WireUi\Components\Drawer;

use Illuminate\Contracts\View\View;
use WireUi\View\WireUiComponent;

class Index extends WireUiComponent
{
    protected array $packs = ['blur', 'height', 'position', 'width'];

    protected array $props = [
        'name' => null,
        'show' => false,
        'z-index' => null,
        'blurless' => false,
        'persistent' => false,
    ];

    public function blade(): View
    {
        return view('wireui-drawer::index');
    }
}
