<?php

namespace WireUi\Components\Alert;

use Illuminate\Contracts\View\View;
use WireUi\Attributes\Process;
use WireUi\Traits\Components\InteractsWithColor;
use WireUi\Traits\Components\InteractsWithRounded;
use WireUi\Traits\Components\InteractsWithVariant;
use WireUi\View\WireUiComponent;

class Index extends WireUiComponent
{
    use InteractsWithColor;
    use InteractsWithRounded;
    use InteractsWithVariant;

    protected array $packs = ['shadow', 'padding'];

    protected array $props = [
        'icon' => null,
        'title' => null,
        'iconless' => false,
        'shadowless' => false,
    ];

    #[Process()]
    protected function process(): void
    {
        $this->icon ??= data_get($this->colorClasses, 'icon', 'bell');
    }

    public function blade(): View
    {
        return view('wireui-alert::index');
    }
}
