<?php

namespace WireUi\View\Components;

class Checkbox extends FormComponent
{
    public $except = ['type'];

    public bool $sm;

    public bool $md;

    public bool $lg;

    public ?string $label;

    public ?string $leftLabel;

    public function __construct(
        bool $md = false,
        bool $lg = false,
        ?string $label = null,
        ?string $leftLabel = null
    ) {
        $this->sm        = !$md && !$lg;
        $this->md        = $md;
        $this->lg        = $lg;
        $this->label     = $label;
        $this->leftLabel = $leftLabel;
    }

    protected function getView(): string
    {
        return 'wireui::components.checkbox';
    }
}
