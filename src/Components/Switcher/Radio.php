<?php

namespace WireUi\Components\Switcher;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupColor;
use WireUi\Traits\Components\HasSetupRounded;
use WireUi\Traits\Components\HasSetupSize;
use WireUi\Traits\Components\HasSetupWrapper;
use WireUi\View\WireUiComponent;

class Radio extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupSize;
    use HasSetupWrapper;

    protected function exclude(): array
    {
        return ['type'];
    }

    protected function blade(): View
    {
        return view('wireui-switcher::radio');
    }
}
