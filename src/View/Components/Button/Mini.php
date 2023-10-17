<?php

namespace WireUi\View\Components\Button;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupButton, HasSetupColor, HasSetupIconSize, HasSetupRounded, HasSetupSize, HasSetupSpinner, HasSetupStateColor, HasSetupVariant};
use WireUi\View\Components\WireUiComponent;

class Mini extends WireUiComponent
{
    use HasSetupButton;
    use HasSetupColor;
    use HasSetupIconSize;
    use HasSetupRounded;
    use HasSetupSize;
    use HasSetupSpinner;
    use HasSetupStateColor;
    use HasSetupVariant;

    protected array $booleans = ['loading', 'iconless'];

    protected array $props = ['label', 'icon', 'right-icon'];

    protected function processed(): void
    {
        $this->loading ??= true;
    }

    public function blade(): View
    {
        return view('wireui::components.button.mini');
    }
}
