<?php

namespace WireUi\View\Components;

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
        public string $padding = 'px-2 py-5 md:px-4',
        public string $rounded = 'rounded-xl',
        public string $shadow = 'shadow-md',
        public string $divider = 'divide-y divide-secondary-200',
        public ?string $title = null,
        public ?string $header = null,
        public ?string $footer = null,
        public bool $fullscreen = false,
        public bool $squared = false,
        public bool $hideClose = false,
    ) {
        if ($fullscreen) {
            $maxWidth = '';
        }

        parent::__construct(
            name: $name,
            zIndex: $zIndex,
            maxWidth: $maxWidth,
            spacing: $spacing,
            align: $align,
            blur: $blur,
            show: $show
        );
    }

    public function render()
    {
        return view('wireui::components.modal-card');
    }
}
