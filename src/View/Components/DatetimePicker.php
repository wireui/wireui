<?php

namespace WireUi\View\Components;

use Carbon\Carbon;
use DateTimeInterface;

class DatetimePicker extends Input
{
    public ?Carbon $min;

    public ?Carbon $max;

    /**
     * @param  Carbon|DateTimeInterface|string|int|null  $min
     * @param  Carbon|DateTimeInterface|string|int|null  $max
     */
    public function __construct(
        bool $borderless = false,
        bool $shadowless = false,
        ?string $rightIcon = 'calendar',
        ?string $label = null,
        ?string $hint = null,
        ?string $cornerHint = null,
        ?string $icon = null,
        ?string $prefix = null,
        ?string $prepend = null,

        public bool $clearable = true,
        public bool $withoutTips = false,
        public bool $withoutTimezone = false,
        public bool $withoutTime = false,
        public int $interval = TimePicker::INTERVAL,
        public string $timeFormat = TimePicker::DEFAULT_FORMAT,
        public ?string $parseFormat = null,
        public ?string $displayFormat = null,
        public ?string $timezone = null,
        public ?string $userTimezone = null,
        public string|int $minTime = 0,
        public string|int $maxTime = 24,

        $min = null,
        $max = null,
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
            prepend: $prepend,
        );

        $this->timezone ??= config('app.timezone', 'UTC');
        $this->min = $min ? Carbon::parse($min) : null;
        $this->max = $max ? Carbon::parse($max) : null;
    }

    protected function getView(): string
    {
        return 'wireui::components.datetime-picker';
    }
}
