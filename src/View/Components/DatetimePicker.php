<?php

namespace WireUi\View\Components;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Contracts\Translation\Translator;

class DatetimePicker extends Input
{
    public bool $clearable;

    public bool $withoutTips;

    public bool $withoutTimezone;

    public bool $withoutTime;

    public bool $mondayFirstDay;

    public int $interval;

    public string $timeFormat;

    public string $timezone;

    public ?string $userTimezone;

    public ?string $parseFormat;

    public ?string $displayFormat;

    public ?Carbon $min;

    public ?Carbon $max;

    public array $weekDays;

    /**
     * @param Carbon|DateTimeInterface|string|int|null $min
     * @param Carbon|DateTimeInterface|string|int|null $max
     */
    public function __construct(
        bool $clearable = true,
        bool $borderless = false,
        bool $shadowless = false,
        bool $withoutTips = false,
        bool $withoutTimezone = false,
        bool $withoutTime = false,
        bool $mondayFirstDay = false,
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
        $min = null,
        $max = null
    ) {
        parent::__construct($borderless, $shadowless, $label, $hint, $cornerHint, $icon, $rightIcon, $prefix, $suffix = null, $prepend, $append = null);

        $this->clearable       = $clearable;
        $this->withoutTips     = $withoutTips;
        $this->withoutTimezone = $withoutTimezone;
        $this->withoutTime     = $withoutTime;
        $this->mondayFirstDay  = $mondayFirstDay;
        $this->timeFormat      = $timeFormat;
        $this->interval        = $interval;
        $this->timezone        = $timezone ?? config('app.timezone', 'UTC');
        $this->userTimezone    = $userTimezone;
        $this->parseFormat     = $parseFormat;
        $this->displayFormat   = $displayFormat;
        $this->min             = $min ? Carbon::parse($min) : null;
        $this->max             = $max ? Carbon::parse($max) : null;
        $this->weekDays        = $this->parseWeekDays();
    }

    protected function parseWeekDays(): array {
        $weekdays = __('wireui::messages.datePicker.days');

        // @todo: I do not really know how to get the array so I do it like this...
        $daysArray = explode('\',', $weekdays);

        foreach ($daysArray as &$day) {
            $day = rtrim(ltrim($day, '[\' '), ']\' ');
        }

        if ($this->mondayFirstDay) {
            $sunday = array_shift($daysArray);
            $daysArray[count($daysArray) + 1] = $sunday;
        }

        return $daysArray;
    }

    protected function getView(): string
    {
        return 'wireui::components.datetime-picker';
    }
}
