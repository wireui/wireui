<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;

class Notifications extends WireUiComponent
{
    protected array $props = ['z-index'];

    protected array $packs = ['position'];

    public function blade(): View
    {
        return view('wireui::components.notifications');
    }
}
