<?php

namespace WireUi\Components\Actions;

use Illuminate\Contracts\View\View;
use WireUi\View\WireUiComponent;

class Notifications extends WireUiComponent
{
    protected array $packs = ['position'];

    protected array $props = [
        'z-index' => null,
    ];

    public function blade(): View
    {
        return view('wireui-actions::notifications');
    }
}
