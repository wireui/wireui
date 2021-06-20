<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;
use WireUi\Support;

class Dialog extends Component
{
    public string $zIndex;

    public string $dialog;

    public ?string $title;

    public ?string $description;

    public function __construct(
        string $zIndex = 'z-50',
        ?string $id = null,
        ?string $title = null,
        ?string $description = null
    ) {
        $this->zIndex      = $zIndex;
        $this->title       = $title;
        $this->dialog      = Support\Dialog::makeEventName($id);
        $this->description = $description;
    }

    public function render()
    {
        return view('wireui::components.dialog');
    }
}
