<?php

namespace WireUi\Components\Card;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\InteractsWithColor;
use WireUi\Traits\Components\InteractsWithRounded;
use WireUi\View\WireUiComponent;

class Index extends WireUiComponent
{
    use InteractsWithColor;
    use InteractsWithRounded;

    protected array $packs = ['shadow', 'padding'];

    protected array $props = [
        'title' => null,
        'borderless' => false,
        'shadowless' => false,
    ];

    public function blade(): View
    {
        return view('wireui-card::index');
    }
}
