<?php

namespace WireUi\Components\TextField;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupColor;
use WireUi\Traits\Components\HasSetupRounded;
use WireUi\Traits\Components\IsFormComponent;
use WireUi\View\WireUiComponent;

class Input extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use IsFormComponent;

    protected array $packs = ['shadow'];

    protected array $props = [
        'shadowless' => false,
    ];

    protected function blade(): View
    {
        return view('wireui-text-field::input');
    }
}
