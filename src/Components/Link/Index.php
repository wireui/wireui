<?php

namespace WireUi\Components\Link;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\InteractsWithButton;
use WireUi\Traits\Components\InteractsWithColor;
use WireUi\Traits\Components\InteractsWithSize;
use WireUi\View\WireUiComponent;

class Index extends WireUiComponent
{
    use InteractsWithButton;
    use InteractsWithColor;
    use InteractsWithSize;

    protected array $packs = ['underline'];

    protected array $props = [
        'label' => null,
    ];

    public function blade(): View
    {
        return view('wireui-link::index');
    }
}
