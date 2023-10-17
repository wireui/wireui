<?php

namespace WireUi\View\Components\Badge;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded, HasSetupSize, HasSetupVariant};
use WireUi\View\Components\WireUiComponent;

class Base extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupSize;
    use HasSetupVariant;

    protected array $packs = ['icon-size'];

    protected array $booleans = ['full', 'iconless'];

    protected array $props = ['label', 'icon', 'right-icon'];

    protected function processed(): void
    {
        $this->full ??= false;
    }

    public function blade(): View
    {
        return view('wireui::components.badge.base');
    }
}
