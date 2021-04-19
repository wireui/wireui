<?php

namespace WireUi\View\Components\Inputs;

class InputPhone extends InputMaskable
{
    public function __construct(
        bool $emitFormatted = false,
        ?string $mask = null,
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
        $mask = $mask ?: $this->getPhoneMask();

        parent::__construct(
            $mask,
            $emitFormatted,
            $color,
            $label,
            $hint,
            $cornerHint,
            $icon,
            $rightIcon,
            $prefix,
            $suffix,
            $prepend,
            $append
        );
    }

    protected function getPhoneMask(): string
    {
        return "['(###) ###-####', '+# ### ###-####', '+## ## ####-####']";
    }
}
