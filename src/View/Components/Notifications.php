<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;

class Notifications extends WireUiComponent
{
    protected array $packs = ['position'];

    protected array $props = [
        'z-index' => false,
    ];

    public function blade(): View
    {
        return view('wireui::components.notifications');
    }
}
