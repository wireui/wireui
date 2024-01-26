<?php

namespace WireUi\Components\Textarea;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded};
use WireUi\View\WireUiComponent;

class Index extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use IsFormComponent;

    protected array $packs = ['shadow'];

    protected array $props = [
        'shadowless' => false,
    ];

    protected function except(): array
    {
        return ['icon', 'right-icon', 'prefix', 'suffix'];
    }

    protected function blade(): View
    {
        return view('wireui-textarea::index');
    }
}
