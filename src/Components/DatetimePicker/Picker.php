<?php

namespace WireUi\Components\DatetimePicker;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use WireUi\Attributes\Process;
use WireUi\Traits\Components\InteractsWithColor;
use WireUi\Traits\Components\InteractsWithRounded;
use WireUi\Traits\Components\InteractsWithWrapper;
use WireUi\View\WireUiComponent;

class Picker extends WireUiComponent
{
    use InteractsWithColor;
    use InteractsWithRounded;
    use InteractsWithWrapper;

    protected array $props = [
        'max' => null,
        'min' => null,
        'label' => null,
        'interval' => 10,
        'max-time' => 24,
        'min-time' => 0,
        'multiple' => false, // boolean
        'timezone' => null,
        'clearable' => true,
        'right-icon' => 'calendar',
        'time-format' => 12,
        'multiple-max' => 0, // integer
        'parse-format' => null,
        'without-time' => false,
        'without-tips' => false,
        'allowed-dates' => [], // [YYYY-MM-DD, [YYYY-MM-DD, YYYY-MM-DD]]
        'start-of-week' => Carbon::SUNDAY,
        'user-timezone' => null,
        'disabled-dates' => [], // [YYYY-MM-DD, [YYYY-MM-DD, YYYY-MM-DD]]
        'disabled-years' => [], // [YYYY, [YYYY, YYYY]]
        'display-format' => null,
        'disabled-months' => [], // [1, 2]
        'without-timezone' => false,
        'disabled-weekdays' => [], // [0, 1]
        'disable-past-dates' => false, // YYYY-MM-DD or boolean
        'without-time-seconds' => false,
        'requires-confirmation' => false,
    ];

    protected function include(): array
    {
        return ['cy', 'dusk', 'disabled', 'readonly', 'required', 'placeholder'];
    }

    #[Process()]
    protected function process(): void
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
