<?php

namespace WireUi\Components\Card;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupColor;
use WireUi\Traits\Components\HasSetupRounded;
use WireUi\View\WireUiComponent;

class Index extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;

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
