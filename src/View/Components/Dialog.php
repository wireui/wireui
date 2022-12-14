<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Actions;

class Dialog extends Modal
{
    public string $dialog;

    public function __construct(
        ?string $zIndex = null,
        ?string $maxWidth = null,
        ?string $spacing = null,
        ?string $align = null,
        ?string $id = null,
        ?string $blur = null,

        public ?string $title = null,
        public ?string $description = null,
    ) {
        parent::__construct(
            name: '',
            zIndex: $zIndex,
            maxWidth: $maxWidth,
            spacing: $spacing,
            align: $align,
            blur: $blur,
        );

        $this->dialog = Actions\Dialog::makeEventName($id);
    }

    public function render(): View
    {
        return view('wireui::components.dialog');
    }
}
