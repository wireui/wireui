<?php

namespace WireUi\Components\Dropdown;

use Illuminate\Contracts\View\View;
use WireUi\View\WireUiComponent;

class Base extends WireUiComponent
{
    protected array $packs = ['width', 'height'];

    protected array $props = [
        'icon' => 'ellipsis-vertical',
        'position' => null,
        'persistent' => false,
    ];

    public function blade(): View
    {
        return view('wireui-dropdown::base');
    }
}
