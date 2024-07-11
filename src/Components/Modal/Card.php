<?php

namespace WireUi\Components\Modal;

use Illuminate\Contracts\View\View;
use WireUi\View\WireUiComponent;

class Card extends WireUiComponent
{
    protected array $props = [
        'persistent' => false,
        'spacing' => null,
        'fullscreen' => false,
        'hide-close' => false,
    ];

    public function blade(): View
    {
        return view('wireui-modal::card');
    }
}
