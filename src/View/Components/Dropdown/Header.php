<?php

namespace WireUi\View\Components\Dropdown;

use Illuminate\Contracts\View\View;
use WireUi\View\Components\WireUiComponent;

class Header extends WireUiComponent
{
    protected array $props = [
        'label'     => null,
        'separator' => false,
    ];

    public function blade(): View
    {
        return view('wireui::components.dropdown.header');
    }
}
