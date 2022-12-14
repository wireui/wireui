<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;

class ModalCard extends Modal
{
    public function __construct(
        public ?string $name = null,
        public ?string $zIndex = null,
        public ?string $maxWidth = null,
        public ?string $spacing = null,
        public ?string $align = null,
        public string|bool|null $blur = null,
        public bool $show = false,
        public ?string $title = null,
        public ?string $padding = null,
        public ?string $shadow = null,
        public ?string $rounded = null,
        public ?string $color = null,
        public bool $fullscreen = false,
        public bool $squared = false,
        public bool $hideClose = false,
    ) {
        parent::__construct(
            name: $name,
            zIndex: $zIndex,
            maxWidth: $fullscreen ? '' : $maxWidth,
            spacing: $spacing,
            align: $align,
            blur: $blur,
            show: $show,
        );
    }

    public function render(): View
    {
        return view('wireui::components.modal-card');
    }
}
