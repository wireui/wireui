<?php

namespace WireUi\View\Components;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\Concerns\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded};

class DatetimePicker extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use IsFormComponent;

    protected array $props = [
        'right-icon'       => 'calendar',
        'clearable'        => true,
        'shadowless'       => false,
        'without-tips'     => false,
        'without-timezone' => false,
        'without-time'     => false,
        'interval'         => TimePicker::INTERVAL,
        'time-format'      => TimePicker::DEFAULT_FORMAT,
        'parse-format'     => null,
        'display-format'   => null,
        'timezone'         => null,
        'user-timezone'    => null,
        'min-time'         => 0,
        'max-time'         => 24,
        'min'              => null,
        'max'              => null,
    ];

    protected array $packs = ['shadow'];

    protected function processed(): void
    {
        $this->timezone ??= config('app.timezone', 'UTC');
        $this->min = Carbon::make($this->min);
        $this->max = Carbon::make($this->max);
    }

    protected function blade(): View
    {
        return view('wireui::components.datetime-picker');
    }
}
