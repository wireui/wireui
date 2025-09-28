<?php

namespace WireUi\Components\Tooltip;

use Illuminate\Contracts\View\View;
use WireUi\View\WireUiComponent;

class Index extends WireUiComponent
{
    public string $positionClasses = '';

    protected array $props = [
        'text' => null,
        'position' => 'top',
        'timeout' => 0,
    ];

    protected function blade(): View
    {
        return view('wireui-tooltip::index');
    }
}
