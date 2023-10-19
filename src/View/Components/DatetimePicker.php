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
    use IsFormComponent {
        finished as finishedForm; // todo: change this
    }

    protected array $props = [
        'right-icon'       => 'calendar',
        'clearable'        => true,
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

    protected function finished(array &$data): void
    {
        $this->finishedForm($data);

        $data['timezone'] ??= config('app.timezone', 'UTC');
        $data['min'] = Carbon::make($data['min']);
        $data['max'] = Carbon::make($data['max']);
    }

    protected function blade(): View
    {
        return view('wireui::components.datetime-picker');
    }
}
