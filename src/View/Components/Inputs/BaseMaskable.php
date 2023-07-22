<?php

namespace WireUi\View\Components\Inputs;

use Exception;
use Illuminate\Support\Str;
use WireUi\View\Components\Input;

abstract class BaseMaskable extends Input
{
    public string $mask;

    public function __construct(
        public bool $emitFormatted = false,

        ?string $mask = null,
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

        $this->mask = $this->formatMask(! $mask ? $this->getInputMask() : $mask);
    }

    protected function getView(): string
    {
        return 'wireui::components.inputs.maskable';
    }

    private function formatMask(string $mask): string
    {
        if (Str::startsWith($mask, '[')) {
            return $mask;
        }

        return "'{$mask}'";
    }

    protected function getInputMask(): string
    {
        throw new Exception('Implement this method [getInputMask] on your component or pass [mask] in parameters');
    }
}
