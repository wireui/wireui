<?php

namespace WireUi\View\Components;

use Illuminate\Support\{Str, Stringable};

class Trix extends FormComponent
{
    public function __construct(
        public ?string $label = '',
        public ?string $name = '',
        public ?string $value = '',
        public ?string $trixId = '',
    ) {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->trixId = 'trix-' . uniqid();
    }

    public function getView(): string
    {
        return 'wireui::components.trix';
    }
}
