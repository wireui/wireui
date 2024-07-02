<?php

namespace WireUi\Components\Dropdown;

use Illuminate\Contracts\View\View;
use WireUi\View\WireUiComponent;

class Header extends WireUiComponent
{
    protected array $props = [
        'label' => null,
        'separator' => false,
    ];

    public function blade(): View
    {
        return view('wireui-dropdown::header');
    }
}
