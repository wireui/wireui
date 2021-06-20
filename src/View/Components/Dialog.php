<?php

namespace WireUi\View\Components;

use WireUi\Support;

class Dialog extends Modal
{
    public string $dialog;

    public ?string $title;

    public ?string $description;

    public function __construct(
        ?string $zIndex = null,
        ?string $maxWidth = null,
        ?string $spacing = null,
        ?string $align = null,
        ?string $id = null,
        ?string $title = null,
        ?string $description = null,
        $blur = null
    ) {
        parent::__construct($zIndex, $maxWidth, $spacing, $align, $blur);

        $this->title       = $title;
        $this->dialog      = Support\Dialog::makeEventName($id);
        $this->description = $description;
    }

    public function render()
    {
        return view('wireui::components.dialog');
    }
}
