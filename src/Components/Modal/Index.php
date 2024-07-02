<?php

namespace WireUi\Components\Modal;

use Illuminate\Contracts\View\View;
use WireUi\View\WireUiComponent;

class Index extends WireUiComponent
{
    protected array $packs = ['align', 'blur', 'width', 'type'];

    protected array $props = [
        'name' => null,
        'show' => false,
        'spacing' => null,
        'z-index' => null,
        'blurless' => false,
        'persistent' => false,
    ];

    public function blade(): View
    {
        return view('wireui-modal::index');
    }
}
