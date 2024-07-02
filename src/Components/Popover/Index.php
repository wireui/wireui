<?php

namespace WireUi\Components\Popover;

use Illuminate\Contracts\View\View;
use WireUi\View\WireUiComponent;

class Index extends WireUiComponent
{
    protected array $props = [
        'margin' => false,
        'root-class' => null,
    ];

    public function blade(): View
    {
        return view('wireui-popover::index');
    }
}
