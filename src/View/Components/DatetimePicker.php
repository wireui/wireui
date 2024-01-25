<?php

namespace WireUi\View\Components;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded};
use WireUi\View\WireUiComponent;

class DatetimePicker extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use IsFormComponent;

    protected array $packs = ['shadow'];

    protected array $props = [
        'max'              => null,
        'min'              => null,
        'interval'         => 10,
        'max-time'         => 24,
        'min-time'         => 0,
        'timezone'         => null,
        'clearable'        => true,
        'right-icon'       => 'calendar',
        'shadowless'       => false,
        'time-format'      => 12,
        'parse-format'     => null,
        'without-time'     => false,
        'without-tips'     => false,
        'user-timezone'    => null,
        'display-format'   => null,
        'without-timezone' => false,
    ];

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
