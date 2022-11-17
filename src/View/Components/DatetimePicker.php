<?php

namespace WireUi\View\Components;

use Carbon\Carbon;
use DateTimeInterface;

class DatetimePicker extends Input
{
    public bool $clearable;

    public bool $withoutTips;

    public bool $withoutTimezone;

    public bool $withoutTime;

    public int $interval;

    public string $timeFormat;

    public string $timezone;

    public ?string $userTimezone;

    public ?string $parseFormat;

    public ?string $displayFormat;

    public string|int $minTime;

    public string|int $maxTime;

    public ?Carbon $min;

    public ?Carbon $max;

    public array $disabledDays;

    /**
     * @param Carbon|DateTimeInterface|string|int|null $min
     * @param Carbon|DateTimeInterface|string|int|null $max
     * @param array<int|Carbon|DateTimeInterface|string>|null $disabledDays
     */
    public function __construct(
        bool $clearable = true,
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
        ?string $prepend = null,
        string|int $minTime = 0,
        string|int $maxTime = 24,
        $min = null,
        $max = null,
        ?array $disabledDays = null,
    ) {
        parent::__construct($borderless, $shadowless, $label, $hint, $cornerHint, $icon, $rightIcon, $prefix, $suffix = null, $prepend, $append = null);

        $this->clearable       = $clearable;
        $this->withoutTips     = $withoutTips;
        $this->withoutTimezone = $withoutTimezone;
        $this->withoutTime     = $withoutTime;
        $this->timeFormat      = $timeFormat;
        $this->interval        = $interval;
        $this->timezone        = $timezone ?? config('app.timezone', 'UTC');
        $this->userTimezone    = $userTimezone;
        $this->parseFormat     = $parseFormat;
        $this->displayFormat   = $displayFormat;
        $this->minTime         = $minTime;
        $this->maxTime         = $maxTime;
        $this->min             = $min ? Carbon::parse($min) : null;
        $this->max             = $max ? Carbon::parse($max) : null;

        $this->disabledDays    = $disabledDays ?? [];
        foreach ($this->disabledDays as $key => $day) {
            if (is_numeric($day) && $day >= 0 && $day <= 6) {
                continue;
            }

            $this->disabledDays[$key] = Carbon::parse($day);
        }
    }

    protected function getView(): string
    {
        return 'wireui::components.datetime-picker';
    }
}
