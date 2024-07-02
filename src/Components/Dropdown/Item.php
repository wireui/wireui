<?php

namespace WireUi\Components\Dropdown;

use Illuminate\Contracts\View\View;
use WireUi\View\WireUiComponent;

class Item extends WireUiComponent
{
    protected array $props = [
        'icon' => null,
        'label' => null,
        'separator' => false,
    ];

    public function blade(): View
    {
        return view('wireui-dropdown::item');
    }
}
