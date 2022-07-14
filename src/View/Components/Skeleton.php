<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;

class Skeleton extends Component
{
    public ?string $name;

    public function __construct(
        ?string $name = 'default',
    ) {
        $this->name = $name;
    }

    public function render()
    {
        return view('wireui::components.skeleton');
    }
}
