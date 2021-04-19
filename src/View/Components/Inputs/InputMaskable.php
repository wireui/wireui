<?php

namespace WireUi\View\Components\Inputs;

use Illuminate\Support\Str;
use WireUi\View\Components\Input;

class InputMaskable extends Input
{
    protected const VIEW = 'wireui::components.inputs.maskable';

    public bool $emitFormatted;

    public string $mask;

    public function __construct(
        string $mask,
        bool $emitFormatted = false,
        ?string $color = null,
        ?string $label = null,
        ?string $hint = null,
        ?string $cornerHint = null,
        ?string $icon = null,
        ?string $rightIcon = null,
        ?string $prefix = null,
        ?string $suffix = null,
        ?string $prepend = null,
        ?string $append = null
    ) {
        parent::__construct($color, $label, $hint, $cornerHint, $icon, $rightIcon, $prefix, $suffix, $prepend, $append);

        $this->mask          = $this->formatMask($mask);
        $this->emitFormatted = $emitFormatted;
    }

    private function formatMask(string $mask): string
    {
        if (Str::startsWith($mask, '[')) {
            return $mask;
        }

        return "'{$mask}'";
    }
}
