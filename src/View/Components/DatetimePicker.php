<?php

namespace WireUi\View\Components;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded};

class DatetimePicker extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use IsFormComponent;

    protected array $packs = ['shadow'];

    protected array $props = [
        'shadowless' => false,
    ];

    public ?Carbon $min;

    public ?Carbon $max;

    /**
     * @param Carbon|DateTimeInterface|string|int|null $min
     * @param Carbon|DateTimeInterface|string|int|null $max
     */
    public function __construct(
        public ?string $rightIcon = 'calendar',
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
        $this->timezone ??= config('app.timezone', 'UTC');
        $this->min = $min ? Carbon::parse($min) : null;
        $this->max = $max ? Carbon::parse($max) : null;
    }

    protected function blade(): View
    {
        return view('wireui::components.datetime-picker');
    }
}
