<?php

namespace WireUi\View\Components\Button;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupButton, HasSetupColor, HasSetupRounded, HasSetupSize, HasSetupSpinner, HasSetupStateColor, HasSetupVariant};
use WireUi\View\Components\WireUiComponent;

class Base extends WireUiComponent
{
    use HasSetupButton;
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupSize;
    use HasSetupSpinner;
    use HasSetupStateColor;
    use HasSetupVariant;

    protected array $packs = ['icon-size'];

    protected array $props = ['label', 'icon', 'right-icon'];

    protected array $booleans = ['full', 'loading', 'iconless'];

    protected function processed(): void
    {
        $this->full ??= false;

        $this->loading ??= true;
    }

    public function blade(): View
    {
        return view('wireui::components.button.base');
    }
}
