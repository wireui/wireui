<?php

namespace WireUi\Components\DatetimePicker;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use WireUi\Traits\Components\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded};
use WireUi\View\WireUiComponent;

class Picker extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use IsFormComponent;

    protected array $packs = ['shadow'];

    protected array $props = [
        'max'                   => null,
        'min'                   => null,
        'interval'              => 10,
        'max-time'              => 24,
        'min-time'              => 0,
        'timezone'              => null,
        'clearable'             => true,
        'right-icon'            => 'calendar',
        'shadowless'            => false,
        'time-format'           => 12,
        'parse-format'          => null,
        'without-time'          => false,
        'without-time-seconds'  => false,
        'without-tips'          => false,
        'start-of-week'         => Carbon::SUNDAY,
        'user-timezone'         => null,
        'display-format'        => null,
        'without-timezone'      => false,
        'requires-confirmation' => false,
        'multiple'              => false, // boolean
        'multiple-max'          => 0,     // integer

        'disabled-years'     => [],    // [YYYY, [YYYY, YYYY]]
        'disabled-months'    => [],    // [1, 2]
        'disabled-weekdays'  => [],    // [0, 1]
        'disabled-dates'     => [],    // [YYYY-MM-DD, [YYYY-MM-DD, YYYY-MM-DD]]
        'disable-past-dates' => false, // YYYY-MM-DD or boolean
        'allowed-dates'      => []     // [YYYY-MM-DD, [YYYY-MM-DD, YYYY-MM-DD]]
    ];

    protected function processed(): void
    {
        $this->timezone ??= config('app.timezone', 'UTC');

        $this->min = Carbon::make($this->min);
        $this->max = Carbon::make($this->max);
    }

    protected function blade(): View
    {
        return view('wireui-datetime-picker::picker');
    }
}
