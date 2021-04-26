<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;

class Dropdown extends Component
{
    public string $width;

    public bool $persistent;

    public ?string $trigger;

    public function __construct(
        string $width = 'w-48',
        bool $persistent = false,
        ?string $trigger = null
    ) {
        $this->width      = $width;
        $this->persistent = $persistent;
        $this->trigger    = $trigger;
    }

    public function render()
    {
        return view('wireui::components.dropdown');
    }
}
