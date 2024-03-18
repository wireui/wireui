<?php

namespace WireUi\Components\Label;

use Illuminate\Contracts\View\View;
use WireUi\View\WireUiComponent;

class Index extends WireUiComponent
{
    protected array $props = [
        'label' => null,
    ];

    public function blade(): View
    {
        return view('wireui-label::index');
    }
}
