<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\Concerns\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded, HasSetupShadow};

class TimePicker extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupShadow;
    use IsFormComponent;

    public const INTERVAL       = 10;
    public const FORMAT_12H     = '12';
    public const FORMAT_24H     = '24';
    public const DEFAULT_FORMAT = self::FORMAT_12H;

    public function __construct(
        public int $interval = self::INTERVAL,
        public string $format = self::DEFAULT_FORMAT,
    ) {
    }

    protected function blade(): View
    {
        return view('wireui::components.time-picker');
    }
}
