<?php

namespace WireUi\View\Components;

class ModalCard extends Modal
{
    public string $shadow;

    public string $divider;

    public string $padding;

    public string $rounded;

    public ?string $title;

    public ?string $header;

    public ?string $footer;

    public bool $fullscreen;

    public bool $squared;

    public bool $hideClose;

    public function __construct(
        ?string $zIndex = null,
        ?string $maxWidth = null,
        ?string $spacing = null,
        ?string $align = null,
        string $padding = 'px-2 py-5 md:px-4',
        string $rounded = 'rounded-xl',
        string $shadow = 'shadow-md',
        string $divider = 'divide-y divide-secondary-200',
        ?string $title = null,
        ?string $header = null,
        ?string $footer = null,
        bool $fullscreen = false,
        bool $squared = false,
        bool $hideClose = false,
        $blur = null
    ) {
        if ($fullscreen) {
            $maxWidth = '';
        }

        parent::__construct($zIndex, $maxWidth, $spacing, $align, $blur);

        $this->padding    = $padding;
        $this->rounded    = $rounded;
        $this->shadow     = $shadow;
        $this->divider    = $divider;
        $this->title      = $title;
        $this->header     = $header;
        $this->footer     = $footer;
        $this->fullscreen = $fullscreen;
        $this->squared    = $squared;
        $this->hideClose  = $hideClose;
    }

    public function render()
    {
        return view('wireui::components.modal-card');
    }
}
