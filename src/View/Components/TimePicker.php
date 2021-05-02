<?php

namespace WireUi\View\Components;

class TimePicker extends Input
{
    protected const VIEW        = 'wireui::components.time-picker';
    public const INTERVAL       = 10;
    public const FORMAT_12H     = '12';
    public const FORMAT_24H     = '24';
    public const DEFAULT_FORMAT = self::FORMAT_12H;

    public int $interval;

    public string $format;

    public function __construct(
        int $interval = self::INTERVAL,
        string $format = self::DEFAULT_FORMAT,
        ?string $color = null,
        ?string $label = null,
        ?string $hint = null,
        ?string $cornerHint = null,
        ?string $icon = null,
        ?string $prefix = null,
        ?string $prepend = null
    ) {
        parent::__construct($color, $label, $hint, $cornerHint, $icon, $rightIcon = null, $prefix, $suffix = null, $prepend, $append = null);

        $this->interval = $interval;
        $this->format   = $format;
    }
}
