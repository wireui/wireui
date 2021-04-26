<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;

class Notifications extends Component
{
    public string $zIndex;

    public function __construct(string $zIndex = 'z-50')
    {
        $this->zIndex = $zIndex;
    }

    public function render()
    {
        return view('wireui::components.notifications');
    }
}
