<?php

namespace WireUi\View\Components;

class DatetimePicker extends Input
{
    public bool $withoutTips;

    public bool $withoutTimezone;

    public bool $withoutTime;

    public int $interval;

    public string $timeFormat;

    public string $timezone;

    public ?string $userTimezone;

    public ?string $parseFormat;

    public ?string $displayFormat;

    public function __construct(
        bool $borderless = false,
        bool $shadowless = false,
        bool $withoutTips = false,
        bool $withoutTimezone = false,
        bool $withoutTime = false,
        int $interval = TimePicker::INTERVAL,
        string $timeFormat = TimePicker::DEFAULT_FORMAT,
        ?string $parseFormat = null,
        ?string $displayFormat = null,
        ?string $rightIcon = 'calendar',
        ?string $timezone = null,
        ?string $userTimezone = null,
        ?string $label = null,
        ?string $hint = null,
        ?string $cornerHint = null,
        ?string $icon = null,
        ?string $prefix = null,
        ?string $prepend = null
    ) {
        parent::__construct($borderless, $shadowless, $label, $hint, $cornerHint, $icon, $rightIcon, $prefix, $suffix = null, $prepend, $append = null);

        $this->withoutTips     = $withoutTips;
        $this->withoutTimezone = $withoutTimezone;
        $this->withoutTime     = $withoutTime;
        $this->timeFormat      = $timeFormat;
        $this->interval        = $interval;
        $this->timezone        = $timezone ?? config('app.timezone', 'UTC');
        $this->userTimezone    = $userTimezone;
        $this->parseFormat     = $parseFormat;
        $this->displayFormat   = $displayFormat;
    }

    protected function getView(): string
    {
        return 'wireui::components.datetime-picker';
    }
}
