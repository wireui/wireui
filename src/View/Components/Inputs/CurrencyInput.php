<?php

namespace WireUi\View\Components\Inputs;

use WireUi\View\Components\Input;

class CurrencyInput extends Input
{
    public function __construct(
        public string $thousands = ',',
        public string $decimal = '.',
        public int $precision = 2,
        public bool $emitFormatted = false,

        bool $borderless = false,
        bool $shadowless = false,
        ?string $label = null,
        ?string $hint = null,
        ?string $cornerHint = null,
        ?string $icon = null,
        ?string $rightIcon = null,
        ?string $prefix = null,
        ?string $suffix = null,
        ?string $prepend = null,
        ?string $append = null,
    ) {
        parent::__construct(
            borderless: $borderless,
            shadowless: $shadowless,
            label: $label,
            hint: $hint,
            cornerHint: $cornerHint,
            icon: $icon,
            rightIcon: $rightIcon,
            prefix: $prefix,
            suffix: $suffix,
            prepend: $prepend,
            append: $append,
        );
    }

    protected function getView(): string
    {
        return 'wireui::components.inputs.currency';
    }
}
