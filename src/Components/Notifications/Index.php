<?php

namespace WireUi\Components\Notifications;

use Illuminate\Contracts\View\View;
use WireUi\View\WireUiComponent;

class Index extends WireUiComponent
{
    protected array $packs = ['position'];

    protected array $props = [
        'z-index' => null,
    ];

    public function blade(): View
    {
        return view('wireui-notifications::index');
    }
}
