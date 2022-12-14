<?php

namespace WireUi\View\Components;

class TimePicker extends Input
{
    public const INTERVAL       = 10;
    public const FORMAT_12H     = '12';
    public const FORMAT_24H     = '24';
    public const DEFAULT_FORMAT = self::FORMAT_12H;

    public function __construct(
        public int $interval = self::INTERVAL,
        public string $format = self::DEFAULT_FORMAT,

        bool $borderless = false,
        bool $shadowless = false,
        ?string $label = null,
        ?string $hint = null,
        ?string $cornerHint = null,
        ?string $icon = null,
        ?string $prefix = null,
        ?string $prepend = null
    ) {
        parent::__construct(
            borderless: $borderless,
            shadowless: $shadowless,
            label: $label,
            hint: $hint,
            cornerHint: $cornerHint,
            icon: $icon,
            prefix: $prefix,
            prepend: $prepend,
        );
    }

    protected function getView(): string
    {
        return 'wireui::components.time-picker';
    }
}
