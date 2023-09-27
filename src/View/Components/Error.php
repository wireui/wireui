<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Error extends Component
{
    public function __construct(
        public string $name,
    ) {
    }

    public function render(): View
    {
        return view('wireui::components.error');
    }
}
