<?php

namespace WireUi\View\Components\Inputs;

use WireUi\View\Components\Input;

class CurrencyInput extends Input
{
    protected const VIEW = 'wireui::components.inputs.currency';

    public string $thousands;

    public string $decimal;

    public int $precision;

    public bool $emitFormatted;

    public function __construct(
        string $thousands = ',',
        string $decimal = '.',
        int $precision = 2,
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

        $this->thousands     = $thousands;
        $this->decimal       = $decimal;
        $this->precision     = $precision;
        $this->emitFormatted = $emitFormatted;
    }
}
