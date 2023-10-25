<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded};

class TimePicker extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use IsFormComponent;

    public const INTERVAL       = 10;
    public const FORMAT_12H     = '12';
    public const FORMAT_24H     = '24';
    public const DEFAULT_FORMAT = self::FORMAT_12H;

    protected array $packs = ['shadow'];

    protected array $props = [
        'format'     => self::DEFAULT_FORMAT,
        'interval'   => self::INTERVAL,
        'right-icon' => 'clock',
        'shadowless' => false,
    ];

    protected function blade(): View
    {
        return view('wireui::components.time-picker');
    }
}
