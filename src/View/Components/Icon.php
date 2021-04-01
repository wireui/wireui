<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;

class Icon extends Component
{
    public string $style;

    public string $name;

    public function __construct(string $name, ?string $style = null)
    {
        $this->name  = $name;
        $this->style = $style ?: config('wireui.icons.style');
    }

    public function render()
    {
        return view('wireui::components.icon');
    }
}
