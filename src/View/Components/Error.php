<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;

class Error extends Component
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function render()
    {
        return view('wireui::components.error');
    }
}
